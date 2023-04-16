$(document).ready(()=>{

    const loginAccount = () =>{
        $(document).on('submit', '#formLogin' ,function(e){
            e.preventDefault();
            reset_login_error()

            var formData = new FormData(this);
            formData.append("action", "logins")

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: ()=> { 
                    $('.btn-loginform').attr('disabled', true);
                    $('.btn-loginform').html('')
                    $('.btn-loginform').html("<i class='fa fa-spinner fa-spin' > </i>")
                },

                success: (response)=> {
                    if(response.status){
                        location.href = response.message;
                    }
                    else{
                        if(response.error === "email"){
                            $('.error-email').css({'display':'block'});
                            $('.error-email').text(response.message)
                        }
                        else{
                            $('.error-password').css({'display':'block'});
                            $('.error-password').text(response.message)
                        }
                    }
                },

                complete: ()=>{
                    $('.btn-loginform').removeAttr('disabled');
                    $('.btn-loginform').html("Login <i class='fa fa-arrow-right' > </i>")
                }

            });
        })

        const reset_login_error = () =>{
            $('.error-email').css({'display':'none'});
            $('.error-email').text("")
            $('.error-password').css({'display':'none'});
            $('.error-password').text("")
        }
    }
    loginAccount()

    const homeShow = () =>{
        $(document).on('click', '.home_show' , ()=>{
            mainScreen()
        })

        const mainScreen = () =>{
            $.ajax({
                type: "POST",
                url: "../../apps/superAdmin/partials/home-partial/home.php",
                success: (response)=>{
                    $('.content').html('')
                    $('.content').html(response)
                }
            })
        }
        
    }
    homeShow()

    const configureShow = ()=>{
        $(document).on('click','.configure_show', ()=>{
            $.ajax({
                type: "POST",
                url: "../../apps/superAdmin/partials/configuration-partial/configuration.php",
                success: function (response) {
                    $('.content').html('')
                    $('.content').html(response)
                    configAccountShowDefault()
                }
            });

        })

        const configAccountShowDefault = () =>{
            $.ajax({
                type: "POST",
                url: "../../apps/superAdmin/partials/configuration-partial/acount.php",
                success: function (response) {
                    $('.configuration-content').html('')
                    $('.configuration-content').html(response)
                }
            });
        }

        const configAccountShow = () =>{
            $(document).on('click', '.account-btn', ()=>{
                configAccountShowDefault()
            })
        }
        configAccountShow()

        const configProfessorShow = () =>{
            $(document).on('click', '.professor-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/professor.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                    }
                });
            })
        }
        configProfessorShow()

        const configSubjectShow = () =>{
            $(document).on('click', '.subject-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/subject.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                        readSubject()
                    }
                });
            })
        }

        // CONFIGURE SUBJECTS ****************************
        configSubjectShow()

        const createSubject = () =>{
            $(document).on('submit', '#configure_form_subject' , function(event){
                event.preventDefault()
                
                var formData = new FormData(this);
                formData.append("action", "createSubjects")

                $.ajax({
                    url: "../../apps/controllers/subject_controller.php",
                    method: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: ()=>{
                        $('.form-submit-btn').html('<i class="fa fa-spinner fa-spin " ></i>')
                        $('.form-submit-btn').attr('disabled', true);
                        $('.form-add-row-btn').attr('disabled', true);
                    },
                    success: (response)=>{
                        if(response.status == true){
                            Swal.fire(
                                'Success',
                                response.message,
                                'success'
                            )
                            readSubject()
                            $(this).trigger("reset");
                        }
                        else{
                            Swal.fire(
                                'Something Wrong',
                                response.message,
                                'error'
                            )
                        }
                    },
                    complete: ()=>{
                        $('.form-submit-btn').html('')
                        $('.form-submit-btn').html("Submit")
                        $('.form-submit-btn').removeAttr('disabled')
                        $('.form-add-row-btn').removeAttr('disabled')
                    }
                })

            })
        }
        createSubject()

        const readSubject = () =>{
            $.ajax({
                url: "../../apps/views/subject_view.php",
                method: "POST",
                data: {'action':'readSubjects'},
                dataType: 'JSON',
                success: (response) =>{
                    $('#fetch-subject').html('')
                    for(i in response){
                        $('#fetch-subject').append("\
                        <span class='table-data-subject' >\
                            <strong>"+response[i]['code']+"</strong>\
                            <strong>"+response[i]['name']+"</strong>\
                            <strong>"+response[i]['year']+"</strong>\
                            <strong>"+response[i]['semester']+"</strong>\
                            <strong><i id='delete-subject' delete-subject='"+response[i]['code']+"' class='fa fa-trash' ></i></strong>\
                        </span>")   
                    }
                }
            })
        }

        const deleteSubject = () =>{
            $(document).on('click', '#delete-subject', function(){

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('delete-subject')
                        $.ajax({
                            method: "POST",
                            url: "../../apps/controllers/subject_controller.php",
                            data: {"id":id ,"action":"deleteSubjects"},
                            dataType: "JSON",
                            success: function(response){
                                if(response.status == true){
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    )
                                    readSubject();
                                }
                                else{
                                    Swal.fire(
                                        'Something Wrong!',
                                        response.message,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                  })
            })
        }
        deleteSubject()

        // CONFIGURE SUBJECTS END -----------------------

        // CONFIGURE CLASSROOMS ****************************

        const configClassRoomShow = () =>{
            $(document).on('click', '.classroom-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/classroom.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                        readClassRoom();
                    }
                });
            })
        }
        configClassRoomShow()

        const createClassRoom = () =>{
            $(document).on('submit', '#configure_form_classroom' , function(event){
               event.preventDefault()

                var formData = new FormData(this);
                formData.append("action", "createClassrooms")
               
               $.ajax({
                method: "POST",
                url: "../../apps/controllers/classroom_controller.php",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: ()=>{
                    $('.form-submit-btn').html('<i class="fa fa-spinner fa-spin " ></i>')
                    $('.form-submit-btn').attr('disabled', true);
                    $('.form-add-row-btn').attr('disabled', true);
                },
                success: function(response){
                    if(response.status == true){
                        Swal.fire(
                            'Added!',
                            response.message,
                            'success'
                        )
                        $(this).trigger("reset");
                        readClassRoom();
                    }
                    else{
                        Swal.fire(
                            'Something Wrong!',
                            response.message,
                            'error'
                        )
                    }
                    
                },
                complete: ()=>{
                    $('.form-submit-btn').html('')
                    $('.form-submit-btn').html("Submit")
                    $('.form-submit-btn').removeAttr('disabled')
                    $('.form-add-row-btn').removeAttr('disabled')
                }
               })

            })
        }
        createClassRoom()

        const readClassRoom = () =>{
            $.ajax({
                url: "../../apps/views/classroom_view.php",
                method: "POST",
                data: {'action':'readClassRooms'},
                dataType: 'JSON',
                success: (response) =>{
                    $('#fetch-classroom').html('')
                    for(i in response){
                        $('#fetch-classroom').append("\
                            <span class='table-data-classroom' >\
                                <strong>"+response[i]['number']+"</strong>\
                                <strong>"+response[i]['type']+" Room</strong>\
                                <strong><i id='delete-classsroom' delete-classroom='"+response[i]['number']+"' class='fa fa-trash' ></i></strong>\
                            </span>")
                    }
                }
            })
        }

        const deleteClassRoom = () =>{
            $(document).on('click', '#delete-classsroom', function(){

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('delete-classroom')
                        $.ajax({
                            method: "POST",
                            url: "../../apps/controllers/classroom_controller.php",
                            data: {"id":id ,"action":"deleteClassRooms"},
                            dataType: "JSON",
                            success: function(response){
                                if(response.status == true){
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    )
                                    readClassRoom();
                                }
                                else{
                                    Swal.fire(
                                        'Something Wrong!',
                                        response.message,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                  })
            })
        }
        deleteClassRoom()
        
        // CONFIGURE CLASSROOMS END -----------------------


        // CONFIGURE SECTION ****************************

        const configSectionShow = () =>{
            $(document).on('click', '.section-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/section.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                        readSection()
                    }
                });
            })
        }
        configSectionShow()

        const createSection = () =>{
            $(document).on('submit', '#configure_form_section' , function(event){
                event.preventDefault()
                
                var formData = new FormData(this);
                formData.append("action", "createSections")

                $.ajax({
                    url: "../../apps/controllers/section_controller.php",
                    method: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: ()=>{
                        $('.form-submit-btn').html('<i class="fa fa-spinner fa-spin " ></i>')
                        $('.form-submit-btn').attr('disabled', true);
                        $('.form-add-row-btn').attr('disabled', true);
                    },
                    success: (response)=>{
                        if(response.status == true){
                            Swal.fire(
                                'Success',
                                response.message,
                                'success'
                            )
                            readSection()
                            $(this).trigger("reset");
                        }
                        else{
                            Swal.fire(
                                'Something Wrong',
                                response.message,
                                'error'
                            )
                        }
                    },
                    complete: ()=>{
                        $('.form-submit-btn').html('')
                        $('.form-submit-btn').html("Submit")
                        $('.form-submit-btn').removeAttr('disabled')
                        $('.form-add-row-btn').removeAttr('disabled')
                    }
                })

            })
        }
        createSection()

        const readSection = () =>{
            $.ajax({
                url: "../../apps/views/section_view.php",
                method: "POST",
                data: {'action':'readSections'},
                dataType: 'JSON',
                success: (response) =>{
                    $('#fetch-section').html('')
                    for(i in response){
                        $('#fetch-section').append("\
                        <span class='table-data-section' >\
                            <strong>"+response[i]['section']+"</strong>\
                            <strong>"+response[i]['year']+"</strong>\
                            <strong><i delete-section='"+response[i]['id']+"' id='delete-section' class='fa fa-trash' ></i></strong>\
                        </span>")
                    }
                }
            })
        }

        const deleteSection = () =>{
            $(document).on('click', '#delete-section', function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('delete-section')
                        $.ajax({
                            method: "POST",
                            url: "../../apps/controllers/section_controller.php",
                            data: {"id":id ,"action":"deleteSections"},
                            dataType: "JSON",
                            success: function(response){
                                if(response.status == true){
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    )
                                    readSection();
                                }
                                else{
                                    Swal.fire(
                                        'Something Wrong!',
                                        response.message,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                  })
            })
        }
        deleteSection()

        // CONFIGURE SECTION END -----------------------

        // CONFIGURE DEPARTMENT ****************************

        const configDepartmentShow = () =>{
            $(document).on('click', '.department-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/department.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                        readDepartment()
                    }
                });
            })
        }
        configDepartmentShow()

        const createDepartment = () =>{
            $(document).on('submit', '#configure_form_department' , function(event){
                event.preventDefault()
                
                var formData = new FormData(this);
                formData.append("action", "createDepartments")

                $.ajax({
                    url: "../../apps/controllers/department_controller.php",
                    method: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: ()=>{
                        $('.form-submit-btn').html('<i class="fa fa-spinner fa-spin " ></i>')
                        $('.form-submit-btn').attr('disabled', true);
                        $('.form-add-row-btn').attr('disabled', true);
                    },
                    success: (response)=>{
                        if(response.status == true){
                            Swal.fire(
                                'Success',
                                response.message,
                                'success'
                            )
                            readDepartment()
                            $(this).trigger("reset");
                        }
                        else{
                            Swal.fire(
                                'Something Wrong',
                                response.message,
                                'error'
                            )
                        }
                    },
                    complete: ()=>{
                        $('.form-submit-btn').html('')
                        $('.form-submit-btn').html("Submit")
                        $('.form-submit-btn').removeAttr('disabled')
                        $('.form-add-row-btn').removeAttr('disabled')
                    }
                })

            })
        }
        createDepartment()

        const readDepartment = () =>{
            $.ajax({
                url: "../../apps/views/department_view.php",
                method: "POST",
                data: {'action':'readDepartments'},
                dataType: 'JSON',
                success: (response) =>{
                    $('#fetch-department').html('')
                    for(i in response){
                        $('#fetch-department').append("\
                        <span class='table-data-department' >\
                            <strong>"+response[i]['code']+"</strong>\
                            <strong>"+response[i]['name']+"</strong>\
                            <strong><i delete-department='"+response[i]['code']+"' id='delete-department' class='fa fa-trash' ></i></strong>\
                        </span>")
                    }
                }
            })
        }

        const deleteDepartment = () =>{
            $(document).on('click', '#delete-department', function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('delete-department')
                        $.ajax({
                            method: "POST",
                            url: "../../apps/controllers/department_controller.php",
                            data: {"id":id ,"action":"deleteDepartments"},
                            dataType: "JSON",
                            success: function(response){
                                if(response.status == true){
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    )
                                    readDepartment();
                                }
                                else{
                                    Swal.fire(
                                        'Something Wrong!',
                                        response.message,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                })
            })
        }
        deleteDepartment()

        // CONFIGURE DEPARTMENT END -----------------------

    }
    configureShow()
})
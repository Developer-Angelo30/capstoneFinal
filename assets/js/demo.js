$(document).ready(()=>{

    const loginAccount = () => {
        $(document).on('submit', '#formLogin', function(e) {
          e.preventDefault();
          reset_login_error();
      
          const formData = new FormData(this);
          formData.append("action", "logins");
      
          const $btnLoginForm = $('.btn-loginform');
          $btnLoginForm.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
      
          $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            beforeSend: () => {
              $btnLoginForm.empty().html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: (response) => {
              if (response.status) {
                location.href = response.message;
              } else {
                if (response.error === "email") {
                  $('.error-email').css('display', 'block').text(response.message);
                } else if (response.error === "password") {
                  $('.error-password').css('display', 'block').text(response.message);
                } else {
                  Swal.fire('Something Wrong', response.message, 'error');
                }
              }
            },
            complete: () => {
              $btnLoginForm.removeAttr('disabled').html('Login <i class="fa fa-arrow-right"></i>');
            }
          });
        });
      
        const reset_login_error = () => {
          $('.error-email, .error-password').css('display', 'none').text("");
        };
      };
      
      loginAccount();

      const homeShow = () => {
        $(document).on('click', '.home_show', mainScreen);
      
        function mainScreen() {
          $.ajax({
            type: "POST",
            url: "../../apps/superAdmin/partials/home-partial/home.php",
            success: function(response) {
              $('.content').html(response);
            }
          });
        }
      };
      
      homeShow();
      
      const createShow = () => {
        $(document).on('click', '.create_show', function() {
          $.ajax({
            type: "POST",
            url: "../../apps/superAdmin/partials/create-partial/create.php",
            success: function(response) {
              $('.content').html(response);
              Create_ShowSubject();
              Create_ShowRoom();
              Create_ShowSection();
              Create_ShowProfessor();
            }
          });
        });
      };
      
      createShow();
      
      function Create_ShowSubject() {
        $.ajax({
          url: "../../apps/views/subject_view.php",
          method: "POST",
          data: { 'action': 'readSubjects' },
          dataType: "JSON",
          success: function(response) {
            $('#subject').html(response);
            for (var i in response) {
              $('#subject').append('<option value="' + response[i]['code'] + '">' + response[i]['code'] + '</option>');
            }
          }
        });
      }
      
      function Create_ShowSection() {
        $.ajax({
          url: "../../apps/views/section_view.php",
          method: "POST",
          data: { 'action': 'readSections' },
          dataType: 'JSON',
          success: function(response) {
            $('#section').html('');
            for (var i in response) {
              $('#section').append('<option value="' + response[i]['id'] + '">' + response[i]['section'] + '</option>');
            }
          }
        });
      }
      
      function Create_ShowProfessor() {
        $.ajax({
          url: "../../apps/views/professor_view.php",
          method: "POST",
          data: { 'action': 'readProfessors' },
          dataType: "JSON",
          success: function(response) {
            $('#professorID').html('');
            for (var i in response) {
              $('#professorID').append('<option value="' + response[i]['id'] + '">' + response[i]['fullname'] + '</option>');
            }
          }
        });
      }
      
      function Create_ShowRoom() {
        $.ajax({
          url: "../../apps/views/classroom_view.php",
          method: "POST",
          data: { 'action': 'readClassRooms' },
          dataType: 'JSON',
          success: function(response) {
            $('#room').html('');
            for (var i in response) {
              $('#room').append('<option value="' + response[i]['number'] + '">' + response[i]['number'] + ' / ' + response[i]['type'] + '</option>');
            }
          }
        });
      }
      

      const createManualSchedule = () => {
        $(document).on('submit', '#createManualScheduleForm', function(event) {
          event.preventDefault();
      
          const formData = new FormData(this);
          formData.append("action", "manuallyCreated");
      
          $.ajax({
            url: "../../apps/controllers/schedule_controller.php",
            method: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(response) {
              const title = response.status ? 'Success' : 'Time Conflict';
              Swal.fire(title, response.message, response.status ? 'success' : 'error');
            }
          });
        });
      };
      createManualSchedule();
      
      const configureShow = () => {
        $(document).on('click', '.configure_show', function() {
          $.ajax({
            type: "POST",
            url: "../../apps/superAdmin/partials/configuration-partial/configuration.php",
            success: function(response) {
              $('.content').html(response);
              configAccountShowDefault();
            }
          });
        });
      };    
      configureShow();
      
      function configAccountShowDefault() {
        $.ajax({
          type: "POST",
          url: "../../apps/superAdmin/partials/configuration-partial/acount.php",
          success: function(response) {
            $('.configuration-content').html(response);
          }
        });
      }
      
      function configAccountShow() {
        $(document).on('click', '.account-btn', configAccountShowDefault);
      }
      
      configAccountShow();
      
      function configSubjectShow() {
        $(document).on('click', '.subject-btn', function() {
          $.ajax({
            type: "POST",
            url: "../../apps/superAdmin/partials/configuration-partial/subject.php",
            success: function(response) {
              $('.configuration-content').html(response);
              readSubject();
            }
          });
        });
      }
      
      configSubjectShow();

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

    const readSubject = () => {
        const fetchSubject = $('#fetch-subject');
        fetchSubject.html('');
      
        $.ajax({
          url: "../../apps/views/subject_view.php",
          method: "POST",
          data: { 'action': 'readSubjects' },
          dataType: 'JSON',
          success: function(response) {
            response.forEach(function(subject) {
              fetchSubject.append(`
                <span class='table-data-subject'>
                  <strong>${subject.code}</strong>
                  <strong>${subject.name}</strong>
                  <strong>${subject.year}</strong>
                  <strong>${subject.semester}</strong>
                  <strong><i class='fa fa-trash delete-subject' delete-subject='${subject.code}'></i></strong>
                </span>
              `);
            });
          }
        });
      };
      
      const deleteSubject = () => {
        $(document).on('click', '.delete-subject', function() {
          const id = $(this).attr('delete-subject');
      
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
              $.ajax({
                method: "POST",
                url: "../../apps/controllers/subject_controller.php",
                data: { "id": id, "action": "deleteSubjects" },
                dataType: "JSON",
                success: function(response) {
                  const title = response.status ? 'Deleted!' : 'Something Wrong!';
                  Swal.fire(title, response.message, response.status ? 'success' : 'error');
                  readSubject();
                }
              });
            }
          });
        });
      };
      
      deleteSubject();
      
      const configClassRoomShow = () => {
        $(document).on('click', '.classroom-btn', () => {
          $.ajax({
            type: "POST",
            url: "../../apps/superAdmin/partials/configuration-partial/classroom.php",
            success: function(response) {
              $('.configuration-content').html(response);
              readClassRoom();
            }
          });
        });
      };
      configClassRoomShow();

      function configProfessorShow() {
        $(document).on('click', '.professor-btn', function() {
          $.ajax({
            type: "POST",
            url: "../../apps/superAdmin/partials/configuration-partial/professor.php",
            success: function(response) {
              $('.configuration-content').html(response);
              readProfessor()
            }
          });
        });
      }
      configProfessorShow();

      const createProfessor = () => {
        $(document).on('submit', '#configure_form_professor', function(event) {
          event.preventDefault();
      
          const formData = new FormData(this);
          formData.append("action", "createProfessors");
      
          $.ajax({
            method: "POST",
            url: "../../apps/controllers/professor_controller.php",
            data: formData,
            processData: false,
            contentType: false,
            // dataType: "JSON",
            beforeSend: () => {
              $('.form-submit-btn').html('<i class="fa fa-spinner fa-spin"></i>');
              $('.form-submit-btn, .form-add-row-btn').attr('disabled', true);
            },
            success: function(response) {
              // const title = response.status ? 'Added!' : 'Something Wrong!';
              // Swal.fire(title, response.message, response.status ? 'success' : 'error');
              // $(this).trigger("reset");
              alert(response)
            },
            complete: () => {
              $('.form-submit-btn').html("Submit");
              $('.form-submit-btn, .form-add-row-btn').removeAttr('disabled');
            }
          });
        });
      };
      createProfessor()

      const readProfessor = () => {
        $.ajax({
          url: "../../apps/views/professor_view.php",
          method: "POST",
          data: { 'action': 'readProfessors' },
          dataType: 'JSON',
          success: function(response) {
            const fetchProfessor = $('#fetch-professor');
            fetchProfessor.html('');
      
            response.forEach(function(professor) {
              fetchProfessor.append(`
              <span class="table-data-professor" >
                  <strong>${professor.fullname}</strong>
                  <strong>${professor.rank}</strong>
                  <strong>${professor.designated}</strong>
                  <strong><i class="fa fa-trash" data-id='${professor.id}' ></i></strong>
              </span>
              `);
            });
          }
        });
      };
      
      const createClassRoom = () => {
        $(document).on('submit', '#configure_form_classroom', function(event) {
          event.preventDefault();
      
          const formData = new FormData(this);
          formData.append("action", "createClassrooms");
      
          $.ajax({
            method: "POST",
            url: "../../apps/controllers/classroom_controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            beforeSend: () => {
              $('.form-submit-btn').html('<i class="fa fa-spinner fa-spin"></i>');
              $('.form-submit-btn, .form-add-row-btn').attr('disabled', true);
            },
            success: function(response) {
              const title = response.status ? 'Added!' : 'Something Wrong!';
              Swal.fire(title, response.message, response.status ? 'success' : 'error');
              $(this).trigger("reset");
              readClassRoom();
            },
            complete: () => {
              $('.form-submit-btn').html("Submit");
              $('.form-submit-btn, .form-add-row-btn').removeAttr('disabled');
            }
          });
        });
      };
      createClassRoom();
      
      const readClassRoom = () => {
        $.ajax({
          url: "../../apps/views/classroom_view.php",
          method: "POST",
          data: { 'action': 'readClassRooms' },
          dataType: 'JSON',
          success: function(response) {
            const fetchClassroom = $('#fetch-classroom');
            fetchClassroom.html('');
      
            response.forEach(function(classroom) {
              fetchClassroom.append(`
                <span class='table-data-classroom'>
                  <strong>${classroom.number}</strong>
                  <strong>${classroom.type} Room</strong>
                  <strong>
                    <i class='fa fa-edit update-classroom' update-classroom='${classroom.number}'></i>
                    <i class='fa fa-trash delete-classroom' delete-classroom='${classroom.number}'></i>
                  </strong>
                </span>
              `);
            });
          }
        });
      };
      
      const deleteClassRoom = () => {
        $(document).on('click', '.delete-classroom', function() {
          const id = $(this).attr('delete-classroom');
      
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
              $.ajax({
                method: "POST",
                url: "../../apps/controllers/classroom_controller.php",
                data: { "id": id, "action": "deleteClassRooms" },
                dataType: "JSON",
                success: function(response) {
                  const title = response.status ? 'Deleted!' : 'Something Wrong!';
                  Swal.fire(title, response.message, response.status ? 'success' : 'error');
                  readClassRoom();
                }
              });
            }
          });
        });
      };
      deleteClassRoom();

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
                        <strong>\
                            <i update-section='"+response[i]['id']+"' id='update-section' class='fa fa-edit' ></i>\
                            <i delete-section='"+response[i]['id']+"' id='delete-section' class='fa fa-trash' ></i>\
                        </strong>\
                    </span>")
                }
            }
        })
    }

    const updateSection = () =>{
        $(document).on('submit', '#update-form-section', function(event){
            event.preventDefault()
            var id = $('#section-id').attr('section-id')
            var formData = new FormData(this);
            formData.append("update-id",id)
            formData.append("action", "updateSections")

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
              }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "../../apps/controllers/section_controller.php",
                        method: "POST",
                        data: formData,
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        success: function(response){
                            if(response.status == true){
                                Swal.fire(
                                    'Updated!',
                                    response.message,
                                    'success'
                                )
                                $('.custom-modal-update').css({"visibility":'hidden'})
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
    updateSection()

    const updateSectionShow= ()=>{
        $(document).on('click', '#update-section', function(){
            var id = $(this).attr('update-section')

            //show modal
            $('.custom-modal-update').css({"visibility":'visible'})

            $.ajax({
                url:"../../apps/views/section_view.php",
                method: "POST",
                data: { 'id':id ,'action':"updateSectionShows"},
                dataType: "JSON",
                success: (response)=>{

                    var year = '';
                    if(response[0]['year'] == 1){
                        year = "1st Year";
                    }
                    else if(response[0]['year'] == 2){
                        year = "2nd Year";
                    }
                    else if(response[0]['year'] == 3){
                        year = "3rd Year";
                    }
                    else if(response[0]['year'] == 4){
                        year = "4th Year";
                    }else{
                        year = "5th Year";
                    }

                    $('.fetch-update-data').html('');
                    $('.fetch-update-data').append('\
                        <div class="form-group" id="section-id" section-id="'+response[0]['id']+'">\
                            <input type="text" id="update-section" name="update-section" value="'+response[0]['name']+'" >\
                        </div>\
                        <div class="form-group">\
                            <select name="update-year" id="update-year">\
                                <option value="1">1st Year</option>\
                                <option value="2">2 nd Year</option>\
                                <option value="3">3rd Year</option>\
                                <option value="4">4th Year</option>\
                                <option value="5">5th Year</option>\
                                <option selected value="'+response[0]['year']+'">Current Year: '+year+' </option>\
                            </select>\
                        </div>\
                    ');
                },
            })

        })
    }
    updateSectionShow()

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

    const searchSection = () =>{
        $(document).on('keyup', '.search-section', function(){
            var search = $(this).val()
            if(search == ""){
                readSection()
            }
            else{
                $.ajax({
                    url: '../../apps/views/section_view.php',
                    method: "POST",
                    data: { 'name':search ,'action':'searchSections'},
                    dataType: "JSON",
                    success: (response)=> {
                        $('#fetch-section').html('')
                        for(i in response){
                            $('#fetch-section').append("\
                            <span class='table-data-section' >\
                                <strong>"+response[i]['section']+"</strong>\
                                <strong>"+response[i]['year']+"</strong>\
                                <strong>\
                                    <i update-section='"+response[i]['id']+"' id='update-section' class='fa fa-edit' ></i>\
                                    <i delete-section='"+response[i]['id']+"' id='delete-section' class='fa fa-trash' ></i>\
                                </strong>\
                            </span>")
                        }
                    }
                })
            }
            
        })
    }
    searchSection()

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
                        <strong>\
                            <i update-department='"+response[i]['code']+"' id='update-department'  class='fa fa-edit' ></i>\
                            <i delete-department='"+response[i]['code']+"' id='delete-department' class='fa fa-trash' ></i>\
                        </strong>\
                    </span>")
                }
            }
        })
    }

    const updateDepartment = () =>{
        $(document).on('submit', '#update-form-department', function(event){
            event.preventDefault()

            var formData = new FormData(this);
            formData.append("action", "updateDepartments")

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
              }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "../../apps/controllers/department_controller.php",
                        method: "POST",
                        data: formData,
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        success: function(response){
                            if(response.status == true){
                                Swal.fire(
                                    'Updated!',
                                    response.message,
                                    'success'
                                )
                                $('.custom-modal-update').css({"visibility":'hidden'})
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
    updateDepartment()

    const updateDepartmentShow= ()=>{
        $(document).on('click', '#update-department', function(){
            var code = $(this).attr('update-department')

            //show modal
            $('.custom-modal-update').css({"visibility":'visible'})

            $.ajax({
                url:"../../apps/views/department_view.php",
                method: "POST",
                data: { 'code':code ,'action':"updateDepartmentShows"},
                dataType: "JSON",
                success: (response)=>{
                    $('.fetch-update-data').html('');
                    $('.fetch-update-data').append('\
                            <div class="form-group">\
                                <input type="text" class="departmentCodeInput" id="update-departmentCode" name="update-department[]" readonly value="'+response[0]['code']+'" >\
                            </div>\
                            <div class="form-group">\
                                <input type="text" id="update-departmentName" name="update-departmentName[]" value="'+response[0]['name']+'" >\
                            </div>\
                    ');
                },
            })

        })
    }
    updateDepartmentShow()

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

    const searchDepartment = () =>{
        $(document).on('keyup', '.search-department', function(){
            var search = $(this).val()

            if(search == ""){
                readDepartment()
            }
            else{
                $.ajax({
                    url: '../../apps/views/department_view.php',
                    method: "POST",
                    data: { 'code':search ,'action':'searchDepartments'},
                    dataType: "JSON",
                    success: (response)=> {
                        $('#fetch-department').html('')
                        for(i in response){
                            $('#fetch-department').append("\
                            <span class='table-data-department' >\
                                <strong>"+response[i]['code']+"</strong>\
                                <strong>"+response[i]['name']+"</strong>\
                                <strong>\
                                    <i update-department='"+response[i]['code']+"' id='update-department' class='fa fa-edit' ></i>\
                                    <i delete-department='"+response[i]['code']+"' id='delete-department' class='fa fa-trash' ></i>\
                                </strong>\
                            </span>")
                        }
                    }
                })
            }
            
        })
    }
    searchDepartment()
    // CONFIGURE DEPARTMENT END -----------------------
})
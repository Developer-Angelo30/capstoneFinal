$(document).ready(()=>{
    

    const loginAccount = () =>{
        $(document).on('submit', '#formLogin' ,function(e){
            e.preventDefault();
            reset_login_error()

            console.log("clicked")

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

        // end for account js




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
                    }
                });
            })
        }
        configSubjectShow()

        const configSectionShow = () =>{
            $(document).on('click', '.section-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/section.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                    }
                });
            })
        }
        configSectionShow()

        const configClassRoomShow = () =>{
            $(document).on('click', '.classroom-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/classroom.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                    }
                });
            })
        }
        configClassRoomShow()

        const configDepartmentShow = () =>{
            $(document).on('click', '.department-btn', ()=>{
                $.ajax({
                    type: "POST",
                    url: "../../apps/superAdmin/partials/configuration-partial/department.php",
                    success: function (response) {
                        $('.configuration-content').html('')
                        $('.configuration-content').html(response)
                    }
                });
            })
        }
        configDepartmentShow()

    }
    configureShow();
})
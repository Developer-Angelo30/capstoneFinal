<div class="scroll account-content">
    <h1>ADD ACCOUNT</h1> <hr>
    <span class="button-up-right">
        <button class="modal-add-account-btn" >ADD ACCOUNT</button>
    </span>
    <div class="account-holder">
        <span class="header-account" >
            <strong>Email</strong>
            <strong>Fullname</strong>
            <strong>Department</strong>
            <strong>Action</strong>
        </span>
        <div class="fetch-account">
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span><span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
            <span class="account-data" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
        </div>
    </div>
    <div class="modal-add-account">
        <form id="configAddProf_Form">
            <i class="modal-add-account-close fa fa-close" ></i>
            <div class="fetch-row" id="add-account-row-fetch">
                <div class="row">
                    <div class="form-group">
                        <input type="text" id="add-email" name="add-email[]" placeholder="Email Address" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="add-fname" name="add-fname[]" placeholder="First Name" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="add-lname" name="add-lname[]" placeholder="Last Name" >
                    </div>
                    <div class="form-group">
                        <select name="add-department[]" id="add-department">
                        <option value="" selected >-- SELECT DEPARTMENT --</option>    
                        <option value="1">CICT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="add-role[]" id="add-role">
                            <option value="" selected >-- ROLE --</option>    
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" ><i class="fa fa-spinner fa-spin " ></i>Submit</button>
                <button type="button" class="form-add-row-btn" ><i class="fa fa-th " ></i> Add row</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready( ()=>{

        const configAccountAddRow = () =>{
            $(document).on('click', '.form-add-row-btn' , ()=>{
                $('#add-account-row-fetch').append(
                    "\
                    <div class='row'>\
                    <div class='form-group'>\
                        <input type='text' id='add-email' name='add-email[]' placeholder='Email Address' >\
                    </div>\
                    <div class='form-group'>\
                        <input type='text' id='add-fname' name='add-fname[]' placeholder='First Name' >\
                    </div>\
                    <div class='form-group'>\
                        <input type='text' id='add-lname' name='add-lname[]' placeholder='Last Name' >\
                    </div>\
                    <div class='form-group'>\
                        <select name='add-department[]' id='add-department'>\
                            <option value=' selected >-- SELECT DEPARTMENT --</option> \
                            <option value='1'>CICT</option>\
                        </select>\
                    </div>\
                    <div class='form-group'>\
                        <select name='add-role[]' id='add-role'>\
                            <option value=' selected >-- ROLE --</option> \
                            <option value='1'>Admin</option>\
                        </select>\
                    </div>\
                </div>\
                   \ "
                )
            })
        }
        configAccountAddRow()

        const acountModalAddShow = () =>{
            $(document).on('click', '.modal-add-account-btn' ,()=>{
                $('.modal-add-account').css({"visibility":'visible'})
            })
        }
        acountModalAddShow()

        const accountModalAddHide = () =>{
            $(document).on('click', '.modal-add-account-close' ,()=>{
                $('.modal-add-account').css({"visibility":'hidden'})
                $('#configAddProf_Form')[0].reset()
                $('#add-account-row-fetch').html('')
                $('#add-account-row-fetch').append(
                    "\
                    <div class='row'>\
                    <div class='form-group'>\
                        <input type='text' id='add-email' name='add-email[]' placeholder='Email Address' >\
                    </div>\
                    <div class='form-group'>\
                        <input type='text' id='add-fname' name='add-fname[]' placeholder='First Name' >\
                    </div>\
                    <div class='form-group'>\
                        <input type='text' id='add-lname' name='add-lname[]' placeholder='Last Name' >\
                    </div>\
                    <div class='form-group'>\
                        <select name='add-department[]' id='add-department'>\
                            <option value=' selected >-- SELECT DEPARTMENT --</option> \
                            <option value='1'>CICT</option>\
                        </select>\
                    </div>\
                    <div class='form-group'>\
                        <select name='add-role[]' id='add-role'>\
                            <option value=' selected >-- ROLE --</option> \
                            <option value='1'>Admin</option>\
                        </select>\
                    </div>\
                </div>\
                   \ "
                )
            })
        }
        accountModalAddHide()
    } )
</script>

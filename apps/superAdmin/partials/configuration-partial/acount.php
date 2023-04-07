<div class="scroll account-content content-configure-design ">
    <h1>ADD ACCOUNT FOR ADMINISTRATOR</h1> <hr>
    <span class="button-up-right">
        <button class="show-modal" >ADD ACCOUNT</button>
    </span>
    <div class="custom-table">
        <span class="table-header-account" >
            <strong>Email</strong>
            <strong>Fullname</strong>
            <strong>Department</strong>
            <strong>Action</strong>
        </span>
        <div class="table-body">
            <span class="table-data-account" >
                <strong>angeloreyes90@gmail.com</strong>
                <strong>Angelo Reyes</strong>
                <strong>CICT</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
        </div>
    </div>
    <div class="custom-modal">
        <form id="configure_form_account">
            <i class="close-modal fa fa-close" ></i>
            <div class="fetch-form-input fetch-form-input-account" >
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
                        <option value="1">CICT</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" ><i class="fa fa-spinner fa-spin " ></i>Submit</button>
                <button type="button" class="form-add-row-btn form-add-row-btn-account" ><i class="fa fa-th " ></i> Add row</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready( ()=>{

        const showModal = () =>{
            $(document).on('click', '.show-modal' ,()=>{
                $('.custom-modal').css({"visibility":'visible'})
            })
        }
        showModal()

        const hideModal = () =>{
            $(document).on('click', '.close-modal' ,()=>{
                $('.custom-modal').css({"visibility":'hidden'})
                $('.row').remove()
                append_Row_Account('.fetch-form-input-account')
            })
        }
        hideModal()

        const add_Row_Account = () => {
            $('.form-add-row-btn-account').off('click').on('click', () => {
                append_Row_Account('.fetch-form-input-account');
            });
        };

        add_Row_Account()

        const append_Row_Account = (element)=>{
            $(element).append(
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
                    <option value='1'>CICT</option>\
                    </select>\
                </div>\
                </div>\
                "
            )
        }
    })
</script>

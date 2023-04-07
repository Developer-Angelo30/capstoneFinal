<div class="scroll department-content content-configure-design">
    <h1>ADD DEPARTMENT</h1> <hr>
    <span class="button-up-right">
        <button class="show-modal" >ADD DEPARTMENT</button>
    </span>
    <div class="custom-table">
        <span class="table-header-department" >
            <strong>Department</strong>
            <strong>DepartmentName</strong>
            <strong>Action</strong>
        </span>
        <div class="table-body">
            <span class="table-data-department" >
                <strong>CICT</strong>
                <strong>College of Information and Communications Technology</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
        </div>
    </div>
    <div class="custom-modal">
        <form id="configure_form_department">
            <i class="close-modal fa fa-close" ></i>
            <div class="fetch-form-input fetch-form-input-department">
                <div class="row">
                    <div class="form-group">
                        <input type="text" id="add-departmentCode" name="add-departmentCode[]" placeholder="ex. CICT" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="add-departmentName" name="add-departmentName[]" placeholder="ex. College of Information and Communications Technology" >
                    </div>
                </div>
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" ><i class="fa fa-spinner fa-spin " ></i>Submit</button>
                <button type="button" class="form-add-row-btn form-add-row-btn-dapartment" ><i class="fa fa-th " ></i> Add row</button>
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
                append_Row_Department('.fetch-form-input-department')
            })
        }
        hideModal()

        const add_Row_Department = () =>{
            $('.form-add-row-btn-dapartment').off('click').on('click', () => {
                append_Row_Department('.fetch-form-input-department');
            });
        }
        add_Row_Department()

         const append_Row_Department = (element)=>{
            $(element).append(
                    "\
                    <div class='row' >\
                        <div class='form-group'>\
                            <input type='text' id='add-departmentCode' name='add-departmentCode[]' placeholder='ex. CICT' >\
                        </div>\
                        <div class='form-group'>\
                            <input type='text' id='add-departmentName' name='add-departmentName[]' placeholder='ex. College of Information and Communications Technology' >\
                        </div>\
                    </div>\
                   \ "
            )
        }

    } )
</script>

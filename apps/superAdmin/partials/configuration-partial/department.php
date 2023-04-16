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
        <div class="table-body" id="fetch-department" >
            <!-- <span class="table-data-department" >
                <strong>CICT</strong>
                <strong>College of Information and Communications Technology</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span> -->
        </div>
    </div>
    <div class="custom-modal">
        <form id="configure_form_department">
            <i class="close-modal fa fa-close" ></i>
            <div class="fetch-form-input fetch-form-input-department">
                <!-- <div class="row">
                    <div class="form-group">
                        <input type="text" id="add-departmentCode" name="add-department[]" placeholder="ex. CICT" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="add-departmentName" name="add-departmentName[]" placeholder="ex. College of Information and Communications Technology" >
                    </div>
                </div> -->
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" >Submit</button>
                <button type="button" class="form-add-row-btn form-add-row-btn-department" ><i class="fa fa-th " ></i> Add row</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready( ()=>{

        var slot = 1;

        const showModal = () =>{
            $(document).on('click', '.show-modal' ,()=>{
                $('.custom-modal').css({"visibility":'visible'})
                $('.row').remove()
                slot = 1;
                append_Row_Department('.fetch-form-input-department', slot)
            })
        }
        showModal()

        const hideModal = () =>{
            $(document).on('click', '.close-modal' ,()=>{
                $('.custom-modal').css({"visibility":'hidden'})
                $('.row').remove()
                slot = 1;
            })
        }
        hideModal()

        const add_Row_Department = () =>{
            $('.form-add-row-btn-department').off('click').on('click', () => {
                slot += 1;
                append_Row_Department('.fetch-form-input-department', slot);
            });
        }
        add_Row_Department()

         const append_Row_Department = (element, slot)=>{
            $(element).append(
                    "\
                    <div class='row' >\
                        <div class='form-group'>\
                            <h5>Slot#"+slot+"</h5>\
                        </div>\
                        <div class='form-group'>\
                            <input type='text' id='add-department' name='add-department[]' placeholder='ex. CICT' >\
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

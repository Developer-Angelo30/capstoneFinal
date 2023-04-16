<div class="scroll section-content content-configure-design ">
    <h1>ADD SECTION</h1> <hr>
    <span class="button-up-right">
        <button class="show-modal" >ADD SECTION</button>
    </span>
    <div class="custom-table">
        <span class="table-header-section" >
            <strong>Section</strong>
            <strong>Year Level</strong>
            <strong>Action</strong>
        </span>
        <div class="table-body" id="fetch-section" >
            <!-- <span class="table-data-section" >
                <strong>BSIT-1</strong>
                <strong>1st Year</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span> -->
        </div>
    </div>
    <div class="custom-modal">
        <form id="configure_form_section">
            <i class="close-modal fa fa-close" ></i>
            <div class="fetch-form-input fetch-form-input-section" >
                <!-- <div class="row">
                    <div class="form-group">
                        <input type="text" id="add-section" name="add-section[]" placeholder="Section" >
                    </div>
                    <div class="form-group">
                        <select name="add-year[]" id="add-year">
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                            <option value="5">5th Year</option>
                        </select>
                    </div>
                </div> -->
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" >Submit</button>
                <button type="button" class="form-add-row-btn form-add-row-btn-section" ><i class="fa fa-th " ></i> Add row</button>
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
                append_Row_Section('.fetch-form-input-section', slot)
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

        const add_Row_Section = () =>{
            $('.form-add-row-btn-section').off('click').on('click', () => {
                slot += 1;
                append_Row_Section('.fetch-form-input-section' , slot);
            });
        }
        add_Row_Section()

         const append_Row_Section = (element, slot)=>{
            $(element).append(
                    "\
                    <div class='row'>\
                        <div class='form-group'>\
                            <h5>Slot#"+slot+"</h5>\
                        </div>\
                        <div class='form-group'>\
                            <input type='text' id='add-section' name='add-section[]' placeholder='Section' >\
                        </div>\
                        <div class='form-group'>\
                            <select name='add-year[]' id='add-section-type'>\
                                <option value='1'>1st Year</option>\
                                <option value='2'>2nd Year</option>\
                                <option value='3'>3rd Year</option>\
                                <option value='4'>4th Year</option>\
                                <option value='5'>5thYear</option>\
                            </select>\
                        </div>\
                    </div>\
                   \ "
            )
        }

    } )
</script>

<div class="scroll subject-content content-configure-design">
    <h1>ADD SUBJECT</h1> <hr>
    <span class="button-up-right">
        <button class="show-modal" >ADD SUBJECT</button>
    </span>
    <div class="custom-table">
        <span class="table-header-subject" >
            <strong>Code</strong>
            <strong>Subject</strong>
            <strong>Year Level</strong>
            <strong>Semester</strong>
            <strong>Action</strong>
        </span>
        <div class="table-body" id="fetch-subject" >
            <!-- <span class="table-data-subject" >
                <strong>CC101</strong>
                <strong>Computer Programming 01</strong>
                <strong>1st Year</strong>
                <strong>1st Semester </strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span> -->
        </div>
    </div>
    <div class="custom-modal">
        <form id="configure_form_subject">
            <i class="close-modal fa fa-close" ></i>
            <div class="fetch-form-input fetch-form-input-subject">
                <!-- <div class="row">
                    <div class="form-group">
                        <h5>Slot#1</h5>
                    </div>
                    <div class="form-group">
                        <input type="text" id="add-code" name="add-code[]" placeholder="Subject Code" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="add-name" name="add-name[]" placeholder="Subject Name" >
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
                    <div class="form-group">
                        <select name="add-semester[]" id="add-semester">
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="add-laboratory[]" id="add-laboratory">
                            <option value="0">Without Laboratory</option>
                            <option value="1">With Laboratory</option>
                        </select>
                    </div>
                </div> -->
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" ><i class="fa fa-spinner fa-spin " ></i>Submit</button>
                <button type="button" class="form-add-row-btn form-add-row-btn-subject" ><i class="fa fa-th " ></i> Add row</button>
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
                append_Row_Subject('.fetch-form-input-subject', slot)
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

        const add_Row_Subject = () =>{
            $('.form-add-row-btn-subject').off('click').on('click', () => {
                slot += 1;
                append_Row_Subject('.fetch-form-input-subject', slot);
            });
        }
        add_Row_Subject()

         const append_Row_Subject = (element, slot)=>{
            $(element).append(
                    "\
                    <div class='row'>\
                        <div class='form-group'>\
                            <h5>Slot#"+slot+"</h5>\
                        </div>\
                        <div class='form-group'>\
                            <input type='text' id='add-code' name='add-code[]' placeholder='Subject Code' >\
                        </div>\
                        <div class='form-group'>\
                            <input type='text' id='add-name' name='add-name[]' placeholder='Subject Name' >\
                        </div>\
                        <div class='form-group'>\
                            <select name='add-year[]' id='add-year'>\
                                <option value='1'>1st Year</option>\
                                <option value='2'>2nd Year</option>\
                                <option value='3'>3rd Year</option>\
                                <option value='4'>4th Year</option>\
                                <option value='5'>5th Year</option>\
                            </select>\
                        </div>\
                        <div class='form-group'>\
                            <select name='add-semester[]' id='add-year'>\
                                <option value='1'>1st Semester</option>\
                                <option value='2'>2nd Semester</option>\
                            </select>\
                        </div>\
                        <div class='form-group'>\
                            <select name='add-laboratory[]' id='add-laboratory'>\
                                <option value='0'>Without Laboratory</option>\
                                <option value='1'>With Laboratory</option>\
                            </select>\
                        </div>\
                    </div>\
                   \ "
            )
        }
    } )
</script>

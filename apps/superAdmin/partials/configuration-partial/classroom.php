<div class="scroll classroom-content  content-configure-design">
    <h1>ADD CLASSROOM</h1> <hr>
    <span class="button-up-right">
        <button class="show-modal" >ADD CLASSROOM</button>
    </span>
    <div class="custom-table">
        <span class="table-header-classroom" >
            <strong>Classroom Number</strong>
            <strong>Classroom Type</strong>
            <strong>Action</strong>
        </span>
        <div class="table-body">
            <span class="table-data-classroom" >
                <strong>101</strong>
                <strong>Lecture Room</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
        </div>
    </div>
    <div class="custom-modal">
        <form id="configure_form_classroom">
            <i class="close-modal fa fa-close" ></i>
            <div class="fetch-form-input fetch-form-input-classroom">
                <div class="row">
                    <div class="form-group">
                        <input type="text" id="add-classroom-number" name="add-classroom-number[]" placeholder="Classroom Number" >
                    </div>
                    <div class="form-group">
                        <select name="add-classroom-type[]" id="add-classroom-type">
                        <option value="Lecture">Lecture Room</option>
                        <option value="Laboratory">Laboratory Room</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" ><i class="fa fa-spinner fa-spin " ></i>Submit</button>
                <button type="button" class="form-add-row-btn form-add-row-btn-classroom" ><i class="fa fa-th " ></i> Add row</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready( ()=>{

        const showModal = () =>{
            $(document).on('click', '.show-modal' ,()=>{
                $('.modal-add-classroom').css({"visibility":'visible'})
            })
        }
        showModal()

        const hideModal = () =>{
            $(document).on('click', 'close-modal' ,()=>{
                $('.custom-modal').css({"visibility":'hidden'})
                $('.row').remove()
                append_Row_Account('.fetch-form-input-classroom')
            })
        }
        hideModal()

        const add_Row_Classroom = () =>{
            $('.form-add-row-btn-classroom').off().on('click', ()=>{
                append_Row_Classroom('.fetch-form-input-classroom')
            })
        }
        add_Row_Classroom()

         const append_Row_Classroom = (element)=>{
            $(element).append(
                    "\
                    <div class='row'>\
                        <div class='form-group'>\
                            <input type='text' id='add-classroom-number' name='add-classroom-number[]' placeholder='Classroom Number' >\
                        </div>\
                        <div class='form-group'>\
                            <select name='add-classroom-type[]' id='add-classroom-type'>\
                            <option value='Lecture'>Lecture Room</option>\
                            <option value='Laboratory'>Laboratory Room</option>\
                            </select>\
                        </div>\
                    </div>\
                   \ "
            )
        }

    } )
</script>

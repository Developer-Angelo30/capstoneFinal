<div class="scroll professor-content  content-configure-design">
    <h1>ADD PROFESSOR</h1> <hr>
    <span class="button-up-right">
        <button class="show-modal" >ADD PROFESSOR</button>
    </span>
    <div class="custom-table">
        <span class="table-header-professor" >
            <strong>Fullname</strong>
            <strong>Rank</strong>
            <strong>Designation</strong>
            <strong>Action</strong>
        </span>
        <div class="table-body" id="fetch-professor" >
            
        </div>
    </div>
    <div class="custom-modal">
        <form id="configure_form_professor">
            <i class="close-modal fa fa-close" ></i>
            <div class="fetch-form-input fetch-form-input-professor">
                <div class="row">
                    <div class="form-group">
                        <input type="text" id="FirstName" name="FirstName[]" placeholder="First Name" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="LastName" name="LastName[]" placeholder="Last Name" >
                    </div>
                    <div class="form-group">
                        <select name="rank[]" id="rank">
                        <option value="Instructor" >Instructor</option>    
                        <option value="Assistant Professor">Assitant Professor</option>
                        <option value="Associative Professor">Associative Professor</option>
                        <option value="Professor">Professor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="designation[]" id="designation">
                            <option value='0' >w/o Designated</option>\
                            <option value='1' >Designated</option>\
                        </select>
                    </div>
                </div>
            </div>
            <div class="end-form">
                <button type="submit" class="form-submit-btn" ><i class="fa fa-spinner fa-spin " ></i>Submit</button>
                <button type="button" class="form-add-row-btn form-add-row-btn-professor" ><i class="fa fa-th " ></i> Add row</button>
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
                append_Row_Professor('.fetch-form-input-professor')
            })
        }
        hideModal()

        const add_Row_Professor = () =>{
            $( '.form-add-row-btn-professor').off('click').on('click' , ()=>{
                append_Row_Professor('.fetch-form-input-professor')
            })
        }
        add_Row_Professor()

        const append_Row_Professor = (element)=>{
            $(element).append(
                    "\
                    <div class='row'>\
                        <div class='form-group'>\
                            <input type='text' id='add-fname' name='add-fname[]' placeholder='First Name' >\
                        </div>\
                        <div class='form-group'>\
                            <input type='text' id='add-lname' name='add-lname[]' placeholder='Last Name' >\
                        </div>\
                        <div class='form-group' >\
                            <select  name='add-rank[]' id='add-rank' >\
                                <option value='1' >Instructor</option>\
                                <option value='2' >Assitant Professor</option>\
                                <option value='3' >Associative Professor</option>\
                                <option value='4' >Professor</option>\
                            </select>\
                        </div>\
                        <div class='form-group' >\
                            <select  name='add-designated[]' id='add-designated' >\
                                <option value='w/o Designated' >w/o Designated</option>\
                                <option value='Designated' >Designated</option>\
                            </select>\
                        </div>\
                    </div>\
                    "
                )
        }

    } )
</script>

<div class="scroll professor-content">
    <h1>ADD PROFESSOR</h1> <hr>
    <span class="button-up-right">
        <button class="modal-add-professor-btn" >ADD PROFESSOR</button>
    </span>
    <div class="professor-holder">
        <span class="header-professor" >
            <strong>Fullname</strong>
            <strong>Rank</strong>
            <strong>Designation</strong>
            <strong>Action</strong>
        </span>
        <div class="fetch-professor">
            <span class="professor-data" >
                <strong>Angelo Reyes</strong>
                <strong>Associative Professor</strong>
                <strong>w/o Designated</strong>
                <strong><i class="fa fa-trash" ></i></strong>
            </span>
        </div>
    </div>
    <div class="modal-add-professor">
        <form id="configAddProf_Form">
            <i class="modal-add-professor-close fa fa-close" ></i>
            <div class="fetch-row" id="add-professor-row-fetch">
                <div class="row">
                    <div class="form-group">
                        <input type="text" id="add-fname" name="add-fname[]" placeholder="First Name" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="add-lname" name="add-lname[]" placeholder="Last Name" >
                    </div>
                    <div class="form-group">
                        <select name="add-rank[]" id="add-rank">
                        <option value="1" >Instructor</option>    
                        <option value="2">Assitant Professor</option>
                        <option value="3">Associative Professor</option>
                        <option value="4">Professor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="add-designated[]" id="add-designated">
                            <option value='w/o Designated' >w/o Designated</option>\
                            <option value='Designated' >Designated</option>\
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

        const configProfessorAddRow = () =>{
            $(document).on('click', '.form-add-row-btn' , ()=>{
                $('#add-professor-row-fetch').append(
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
            })
        }
        configProfessorAddRow()

        const acountModalAddShow = () =>{
            $(document).on('click', '.modal-add-professor-btn' ,()=>{
                $('.modal-add-professor').css({"visibility":'visible'})
            })
        }
        acountModalAddShow()

        const professorModalAddHide = () =>{
            $(document).on('click', '.modal-add-professor-close' ,()=>{
                $('.modal-add-professor').css({"visibility":'hidden'})
                $('#configAddProf_Form')[0].reset()
                $('#add-professor-row-fetch').html('')
                $('#add-professor-row-fetch').append(
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
            })
        }
        professorModalAddHide()
    } )
</script>

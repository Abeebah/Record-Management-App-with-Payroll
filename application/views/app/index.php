<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id = "pass-change-error-div"></div>
                <form>
                    <div class="form-group">
                        <label for="current-password" class="col-form-label">Current Password</label>
                        <input type="password" class="form-control" id="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password" class="col-form-label">New Password</label>
                        <input type="password" class="form-control" id="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password" class="col-form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password">
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit" id = "change-password" >
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id = "error-div"></div>
                <form>
                    <input type = "hidden" id = "action-type" value = "">
                    <input type = "hidden" id = "company-id" value = "">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Company Name</label>
                        <input type="text" class="form-control" id="company-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description</label>
                        <textarea class="form-control" id="company-text"></textarea>
                    </div>
                    <div class = "row">
                        <div class="col-md-4">
                            <div id = "edit-profile-pic-div"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="company-logo" name = "company_logo" onchange = "company_logo_upload()">
                                    <label class="custom-file-label" for="customFile" id = "company-logo-label">Upload Picture</label>
                                </div>       
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" id = "company-process" value="Submit">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id = "cat-error-div"></div>
                <form>
                    <input type = "hidden" id = "cat-action-type" value = "">
                    <input type = "hidden" id = "category-id" value = "">
                    <div class="form-group">
                        <label for="category-name" class="col-form-label">Category Name</label>
                        <input type="text" class="form-control" id="category-name">
                    </div>
                    <div class = "form-group">
                        <label for="category-class" class="col-form-label">Class</label>
                        <select class = "form-control" id = "category-class">
                            <option value = "Credit">Credit</option>
                            <option value = "Debit">Debit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category-text" class="col-form-label">Description</label>
                        <textarea class="form-control" id="category-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit" id = "category-process">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id = "edit-user-error-div"></div>
                <form>
                    <input type = "hidden" id = "user-action-type" value = "">
                    <input type = "hidden" id = "edit-user-id" value = "">
                    <div class = "row">                 
                        <div class="col-md-6">
                            <div class = "form-group">
                                <input type="text" class="form-control" id = "edit-firstname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id = "edit-lastname" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-6">
                            <div class="form-group">                    
                                <input type="text" class="form-control" id = "edit-address" placeholder="Home address">
                            </div>               
                        </div>
                                                    
                        <div class="col-md-6">                        
                            <div class="form-group">
                                <input type="email" class="form-control" id = "edit-email" placeholder="Email address" readonly>
                            </div> 
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-7">
                            <div class="form-group">                    
                                <input type="text" class="form-control" id = "edit-username" placeholder="Username" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select class="form-control" id = "edit-gender">
                                    <option value = "">Gender</option>
                                    <option value = "1">Male</option>
                                    <option value = "2">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="col-md-6">
                            <div class="form-group">                    
                                <input type="text" class="form-control" id = "edit-position" placeholder="Position">
                            </div>
                        </div> 
                        <div class="col-md-6">                        
                            <div class="form-group">                    
                                <input type="text" class="form-control" id = "edit-phone" placeholder="Phone number">
                            </div>
                        </div> 
                    </div>
                    <div class = "row"> 
                        <div class="col-md-4">           
                            <div class="form-group">
                                <select class="form-control" id = "edit-company">
                                    <option value = "">Select Company</option>
                                </select>
                            </div>
                        </div>     
                        <div class="col-md-4">           
                            <div class="form-group">
                                <select class="form-control" id = "edit-role">
                                    <option value = "">User Role</option>
                                    <option value = "1">Admin</option>
                                    <option value = "2">User</option>
                                </select>
                            </div>
                        </div>
                        <div class = "col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id = "edit-salary" placeholder="Salary">
                            </div> 
                        </div>              
                    </div>
                    <div class = "row">
                        <div class="col-md-4">
                            <div id = "edit-profile-pic-div"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit-profile-pic" name = "profile_pic" onchange = "edit_profile_pic_upload()">
                                    <label class="custom-file-label" for="customFile" id = "edit-profile-pic-label">Upload Picture</label>
                                </div>       
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit" id = "user-edit-process">
            </div>
        </div>
    </div>
</div>

<div id = "content-div"></div>
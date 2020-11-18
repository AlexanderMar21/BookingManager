<br>
<h1 class="alert alert-info">Add New User </h1>

<form action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="userName">Name</label>
            <input type="text" class="form-control" id="userName" name = "userName" placeholder="name">
        </div>

        <div class="form-group col-md-4">
            <label for="userSurname">Surname</label>
            <input type="text"  autocomplete="off" value="" class="form-control" id="userSurname" name = "userSurname" placeholder="surname">
        </div>
        <div class="form-group col-md-4">
            <label for="userUserName">Username</label>
            <input type="text"  class="form-control" id="userUserName" name = "userUserName" placeholder="username" >
        </div>
        <div class="form-group col-md-4">
            <label for="userPassword">Password</label>
            <input   autocomplete="off" type="password" class="form-control" id="userPassword" name = "userPassword" >
        </div>
        <div class="form-group col-md-4">
            <label for="userPassword2">Repeat Password</label>
            <input type="password" class="form-control" id="userPassword2" name = "userPassword2" >
        </div>
        <div class="form-group col-md-4">
            <label for="userType">User Type</label>
            <select  class="form-control" id="userType" name = "userType" >
                <option value="0">Simple User</option>
                <option value="1">Admin</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="profilePic">Profile Picture </label>
            <input type="file" class="form-control"  id="profilePic" name = "profilePic" >
        </div>



    </div>
    <?php  echo ($message !="")?"<div class='p-3 mb-2 bg-warning text-dark'>{$message}</div>":"";?>
    <button type="submit" class="btn btn-primary" name="addNewUser">Add User</button>
    <br>
</form>
<br>
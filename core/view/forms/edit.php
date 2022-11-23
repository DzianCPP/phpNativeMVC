<?php $user = $data; ?>
<div class="main-div">
    <h1 class="new-user-h1" id="main-page-h1">Edit User</h1>

    <form class="new-user-form">
      <div><label for="email">E-mail</label></div>
      <div><input
              type="text"
              class="input-text"
              name="new-email"
              id="email"
              placeholder="Enter your email"
              onchange="formValid()"
              value="<?php echo $user['email'];; ?>">
      </div>

      <div>
        <label class="form-label" for="name">Your first and last name</label>
      </div>
      <div>
        <input type="text"
               class="input-text"
               name="new-name"
               id="name"
               placeholder="Enter your first and last name"
               onchange="formValid()"
               value="<?php echo $user['fullName']; ?>">
      </div>

      <div><label class="form-label" for="gender">Gender</label></div>

      <div><select name="new-gender" id="gender" class="input-select">
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="transgender">Transgender</option>
        <option value="non-binary">Non-binary</option>
        <option value="other">Other</option>
      </select></div>

      <div><label class="form-label" for="status">Status</label>
        <select name="new-status" class="input-select" id="status">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select></div>

      <button type="button"
              class="form-submit"
              id="submit-button"
              value="submit"
              disabled
              onclick="sendPutRequest()">Submit
      </button>

      <div>
        <p id="error-field"></p>
      </div>

      <div>
        <input type="hidden"
               value="<?php echo $userID ?>"
               name="user-id"
               id="user-id">
      </div>

      <script type="text/javascript" src="/assets/scripts/formValid.js"></script>
      <script type="text/javascript" src="/assets/scripts/users/edit.js"></script>
    </form>
</div>
<?php include "components/header.html"; ?>

    <div class="container-xs container-sm container-md container-xl pt-5">
        <div class="row w-100 mt-5">
            <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
            <div class="col-xs-10 col-sm-8 col-md-6 col-xl-4">
                <h1 class="h1 w-100 m-1" id="main-page-h1">Edit User</h1>
            </div>
            <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
        </div>

        <form class="form">
            <div class="row w-auto mt-2">
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-xl-4">
                    <div class="input-group">
                        <label class="input-group-text w-25" for="email">E-mail</label>
                        <input type="text"
                               class="form-control w-75"
                               name="new-email"
                               id="email"
                               placeholder="Enter your email"
                      value="<?php echo $user['email'];; ?>">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
            </div>

            <div class="row w-auto mt-2">
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-xl-4">
                    <div class="input-group">
                        <label class="input-group-text w-25" for="name">Full Name</label>
                        <input
                                type="text"
                                class="form-control w-75"
                                name="new-name"
                                id="name"
                                placeholder="Enter your first and last name"
                       value="<?php echo $user['fullName']; ?>">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
            </div>

            <div class="row w-auto mt-2">
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-xl-4">
                    <div class="input-group">
                        <label class="input-group-text w-25" for="gender">Gender</label>
                        <select name="gender" id="gender" class="btn btn-success dropdown-toggle w-75">
                      <?php foreach ($genders as $key => $upperCaseGender): ?>
                          <option
                                  <?php if ($user['gender'] === $key):
                                            echo 'selected="selected"';
                                          endif;?>
                                  value="<?php echo $key; ?>">
                              <?php echo $upperCaseGender; ?>
                          </option>
                      <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>

            <div class="row w-auto mt-2 mb-2">
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-xl-4">
                    <div class="input-group">
                        <label class="input-group-text w-25" for="status">Status</label>
                        <select name="status" class="btn btn-success dropdown-toggle w-75" id="status">
                    <?php foreach ($statuses as $key => $upperCaseStatus): ?>
                        <option
                            <?php if ($user['status'] === $key):
                                        echo 'selected="selected"';
                            endif; ?>
                                value="<?php echo $key; ?>">
                            <?php echo $upperCaseStatus; ?>
                        </option>
                    <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>

            <div class="row w-auto">
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-xl-4">
                    <button type="button" class="btn btn-success w-100" id="submit-button" value="submit" disabled>Submit</button>
                </div>
                <div class="col-xs-1 col-sm-2 col-md-3 col-xl-4"></div>
            </div>

            <div>
                <input type="hidden"
                       value="<?php echo $user['userID']; ?>"
                       name="user-id"
                       id="user-id">
            </div>

            <div class="row w-100">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="alert mt-1" id="error-field-div">
                        <p id="error-field"></p>
                    </div>
                </div>
            </div>
        </form>

        <script type="text/javascript" src="/assets/scripts/formValid.js"></script>
        <script type="text/javascript" src="/assets/scripts/users/edit.js"></script>
    </div>
    <?php include "components/footer.html"; ?>
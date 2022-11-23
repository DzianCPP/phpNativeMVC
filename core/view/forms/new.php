<?php
    if ($data === null):
        $email = $fullName = '';
    endif;
?>

<div class="main-div">
<h1 class="new-user-h1" id="main-page-h1">Add User App</h1>

    <form class="new-user-form" method="POST" action="/user/create">

        <?php if ($email === ''): ?>
        <div><label for="email">E-mail</label></div>
       <div><input type="text"
                   class="input-text"
                   name="email"
                   id="email"
                   placeholder="Enter your email"
                   onchange="formValid()"></div>
        <?php else: ?>
        <div><label for="email">E-mail</label></div>
        <div><input
                type="text"
                class="input-text"
                name="email"
                id="email"
                placeholder="Enter your email"
                onchange="formValid()"
                value="<?php echo $email; ?>"
                style="color: red;"></div>
        <?php endif; ?>


        <?php if ($fullName === ''): ?>
        <div><label class="form-label" for="name">Your first and last name</label></div>
        <div>
            <input
                    type="text"
                    class="input-text"
                    name="name"
                    id="name"
                    placeholder="Enter your first and last name"
                    onchange="formValid()">
        </div>

        <?php else: ?>
        <div><label class="form-label" for="name">Your first and last name</label></div>
        <div>
            <input type="text"
                    class="input-text"
                    name="name"
                    id="name"
                    placeholder="Enter your first and last name"
                    onchange="formValid()"
                    value="<?php echo $fullName;?>"
                    style="color: red;">
        </div>

        <?php endif; ?>

        <div><label class="form-label" for="gender">Gender</label></div>

        <div><select name="gender" id="gender" class="input-select">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="transgender">Transgender</option>
            <option value="non-binary">Non-binary</option>
            <option value="other">Other</option>
        </select></div>

        <div><label class="form-label" for="status">Status</label>
        <select name="status" class="input-select" id="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select></div>

        <button type="submit" class="form-submit" id="submit-button" value="submit" disabled>Submit</button>

        <div>
            <p id="error-field">
                <?php
                    if ($email !== '' || $fullName !== ''):
                        echo "Not valid information!";
                    endif;
                ?>
            </p>
        </div>

        <script type="text/javascript" src="/assets/scripts/formValid.js"></script>
    </form>
</div>
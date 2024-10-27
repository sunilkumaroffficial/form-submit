<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Form Submit</title>

    @vite(['resources/sass/app.scss'])
</head>
<body class="antialiased">
    <!-- Modal container -->
    <div class="model" id="model">
        <div class="model_content">
            <!-- Modal header -->
            <div class="model_header">
                <button class="model_close_btn" id="close_model">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="model_body">
                <div class="form_section">
                    <!-- Alert box -->
                    <div class="alert_box" id="form_alert_box">
                        <div class="alert_box_content" id="form_alert_box_content"></div>
                    </div>

                    <div class="form_data">
                        <h1 class="form_title">Create Your Account</h1>
                        <form id="user_form" enctype="multipart/form-data">
                            @csrf
                            <div class="input_box">
                                <label for="name" class="form_label">Name</label>
                                <input type="text" class="form_control" id="name" name="name"
                                    placeholder="Enter your name">
                            </div>
                            <div class="input_box">
                                <label for="email" class="form_label">Email</label>
                                <input type="email" class="form_control" id="email" name="email"
                                    placeholder="Enter your email address">
                            </div>
                            <div class="input_box">
                                <label for="phone" class="form_label">Phone</label>
                                <input type="text" class="form_control" id="phone" name="phone"
                                    placeholder="Enter your phone number">
                            </div>
                            <div class="input_box">
                                <label for="description" class="form_label">Description</label>
                                <textarea class="form_control" id="description" name="description" placeholder="Write something here..." rows="4"></textarea>
                            </div>
                            <div class="input_box">
                                <select name="role_id" id="role" class="form_control">
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                            <div class="input_box">
                                <input type="file" class="form_control" id="profile" name="profile" hidden>
                                <button type="button" class="file_upload_btn"
                                    onclick="document.getElementById('profile').click();">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M288 109.3L288 352c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-242.7-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352l128 0c0 35.3 28.7 64 64 64s64-28.7 64-64l128 0c35.3 0 64 28.7 64 64l0 32c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64l0-32c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                                    </svg>
                                    <span id="file_name">Select Profile</span>
                                </button>
                            </div>
                            <button type="submit" class="btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main section -->
    <div class="main_section">
        <!-- Table data -->
        <button class="btn model_open_btn" id="open_model">Add User</button>

        <!-- Alert box -->
        <div class="alert_box" id="table_alert_box">
            <div class="alert_box_content" id="table_alert_box_content"></div>
        </div>

        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Description</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</body>

@vite(['resources/js/app.js'])

</html>
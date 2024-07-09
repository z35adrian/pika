<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="styles/login.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="cek_login.php" method="post" class="sign-in-form">
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" autocomplete="username" placeholder="Username" required="yes">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" id="id_password" required="yes">
                        <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </div>

                    <input type="submit" value="Sign in" class="btn solid">

                    <div class="social-media">
                        <a class="icon-mode" onclick="toggleTheme('dark');"><i class="fas fa-moon"></i></a>
                        <a class="icon-mode" onclick="toggleTheme('light');"><i class="fas fa-sun"></i></a>
                    </div>
                    <p class="text-mode">Change theme</p>
                </form>
                <form action="register.php" method='post' class="sign-up-form">
                    <h2 class="title">Register</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" autocomplete="username" placeholder="Username" required="yes">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" autocomplete="current-password" placeholder="Password" id="id_reg" required="yes">
                        <i class="far fa-eye" id="toggleReg" style="cursor: pointer;"></i>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password2" autocomplete="current-password" placeholder="Confirm Password" id="id_reg" required="yes">
                        <i class="far fa-eye" id="toggleReg" style="cursor: pointer;"></i>
                    </div>


                    <label class="check">
                        <input type="checkbox" checked="checked">
                        <span class="checkmark">I accept the <a href="terms.html">terms and services</a></span>
                    </label>
                    <input type="submit" value="Create account" class="btn solid">

                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>You don't have an account?</h3>
                    <p>Create your account right now to follow people and like publications</p>
                    <button class="btn transparent" id="sign-up-btn">Register</button>
                </div>
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Already have an account?</h3>
                    <p>Login to see your notifications and post your favorite photos</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

        const htmlEl = document.getElementsByTagName("html")[0];
        const currentTheme = localStorage.getItem("theme") ?
            localStorage.getItem("theme") :
            null;
        if (currentTheme) {
            htmlEl.dataset.theme = currentTheme;
        }
        const toggleTheme = (theme) => {
            htmlEl.dataset.theme = theme;
            localStorage.setItem("theme", theme);
        };

        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#id_password");

        togglePassword.addEventListener("click", function(e) {
            const type =
                password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("fa-eye-slash");
        });

        const toggleReg = document.querySelector("#toggleReg");
        const pass = document.querySelector("#id_reg");

        toggleReg.addEventListener("click", function(e) {
            const type = pass.getAttribute("type") === "password" ? "text" : "password";
            pass.setAttribute("type", type);
            this.classList.toggle("fa-eye-slash");
        });
    </script>
    <script src="main.js"></script>

</body>
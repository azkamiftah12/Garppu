   function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var checkbox = document.querySelector("input[type=checkbox]");

        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }

        // Update the checkbox label
        checkbox.checked ? checkbox.checked = true : checkbox.checked = false;
    }

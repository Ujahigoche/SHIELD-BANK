<?php



$fnerr = $lnerr = $snerr= $pherr = $emerr = $bvnerr = $paerr = $cperr = $adderr = $addperr= $iderr= $tperr= $cterr= $sterr= $cierr= $doberr="";
    $firstname = $lastname = $surname= $phone= $email = $bvn = $cpassword = $address = $address_proof =$state=$idproof=$city=$transaction_pin=$dob=$country"";

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if a file was selected
        if (isset($_FILES["address_proof" || "id_proof"])) {
            $target_dir = "register_form.php/";
            $target_file = $target_dir . basename($_FILES["address_proof" || "id_proof"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if the file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
    
            // Check file size (you can modify this as needed)
            if ($_FILES["address_proof" || "id_proof"]["size"] > 600000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
    
            // Allow certain file formats (you can modify this as needed)
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
                echo "Sorry, only JPG, JPEG, PNG, and pdf files are allowed.";
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                // If everything is OK, try to upload the file
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["address_proof" || "id_proof"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
             $iderr=$address="please, enter a valid file!";
        }
    }

    
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
        $firstname = sanitizeInput($_POST['firstname']);
        $lastname = sanitizeInput($_POST['lastname']);
        $surname = sanitizeInput($_POST['surname']);
        $phone = sanitizeInput($_POST['phone']);
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);
        $cpassword = sanitizeInput($_POST['confirm_password']);
        $address = sanitizeInput($_POST['address']);
        $address_proof = sanitizeInput($_POST['address_proof']);
        $bvn = sanitizeInput($_POST['bvn']);
        $transaction_pin = sanitizeInput($_POST['transaction_pin']);
        $state = sanitizeInput($_POST['state']);
        $idproof = sanitizeInput($_POST['id_proof']);
        $city = sanitizeInput($_POST['city']);
        $country = sanitizeInput($_POST['country']);
        $dob = sanitizeInput($_POST['dob']);
    
        if (preg_match('/^0[789][01]\d{8}$|^\+234[789][01]\d{8}$/', $phone)){
            // Check if the phone is taken
            $sql = "SELECT * FROM users WHERE phone_number = '$phone'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0) {
                $pherr = "{$phone} already exists";
            }
        } else {
            $pherr = "{$phone} is invalid";
        }

        // Email verification
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if the email is taken
            $sql = "SELECT * FROM users WHERE email = '$email' ";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0) {
                $emerr = "{$email} already exists";
            }
        } else {
            $emerr = "{$email} is invalid";
        }
        if($password == $cpassword) {
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            // $hashpass = sha1($password);
        } else {
            $paerr = $cperr = "Passwords do not match";
        } if (empty($fnerr) && empty($lnerr) && empty($snerr) && empty($pherr) && empty($emerr) && empty ($paerr) && empty($cperr) && empty($adderr) && empty($sterr) && empty($bvnerr) && empty($tperr) && empty($addperr) && empty($iderr) && empty($cerr) && empty($cierr) && empty($doberr ) ){
            $sql = "INSERT INTO users(first_name, last_name,surname, phone_number, email, bvn,transacton_pin,city,state,address_proof,idproof,country,dob, password, address ) VALUES ('$firstname','$lastname','$surname','$phone','$email','$bvn','$dob',$country','$hashpass',$sterr,'$address','$address_proof','$transaction_pin',$idproof,'$city')";
            if(mysqli_query($conn, $sql)) {
                echo <h2>Registration Completed</h2>
                $firstname = $lastname = $surname= $phone= $email = $bvn = $cpassword = $address = $address_proof = $state= $idproof= $city= $transaction_pin= $dob= $country="";   
            } else{
                echo "<h2>Error completing registration</h2>";
        }
       }


    <body>
                <h2>Register With Us</h2>
    <form action="register_form.php" method="post" enctype="multipart/form-data">
        <!-- Personal Information -->
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="firstname" required>
        <span class='error'><?php echo $fnerr  ?></span>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="lastname" required>
        <span class='error'><?php echo $lnerr  ?></span>


        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" required>
        <span class='error'><?php echo $snerr  ?></span>


        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        <span class='error'><?php echo $doberr  ?></span>

        

        <!-- Identification Information -->
        <label for="bvn">BVN:</label>
        <input type="text" id="bvn" name="bvn" required>
        <span><?php echo $bvnerr   ?></span>


        <label for="id_proof">Proof of Identity (NIN):</label>
        <input type="file" id="id_proof" name="id_proof" accept=".pdf, .jpg, .jpeg, .png" required>
        <span class='error'><?php echo $iderr  ?></span>


        <label for="address_proof">Proof of Address (Utility Bill):</label>
        <input type="file" id="address_proof" name="address_proof" accept=".pdf, .jpg, .jpeg, .png" required>
        <span class='error'><?php echo $addperr  ?></span>


        <!-- Contact Information -->
        <label for="address">House Address:</label>
        <textarea id="address" name="address" required></textarea>
        <span class='error'><?php echo $adderr   ?></span>


        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
        <span class='error'><?php echo $cierr  ?></span>


        <label for="state">State:</label>
        <input type="text" id="state" name="state" required>
        <span class='error' ><?php echo $sterr  ?></span>

        
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required>
        <span class='error'><?php echo $cterr  ?></span>


        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>
        <span class='error'><?php echo $emerr   ?></span>


        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" required>
        <span class='error'><?php echo $pherr   ?></span>


        <!-- Security Information -->
        <label for="transaction_pin">Transaction PIN:</label>
        <input type="password" id="transaction_pin" name="transaction_pin" required>
        <span class='error'><?php echo  $tperr  ?></span>


        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span class='error'><?php echo $paerr  ?></span>


        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <span class='error'><?php echo $cperr  ?></span>


        <!-- Submit Button -->
        <input type="submit" value="Submit">
    </form>
</body>
</html>



?>
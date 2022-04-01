<?php
//function to restrict which server pages can be accessed based on the account type

function checkFilePermission()
{
    $commonFiles = [];
    $AllowedFiles = [];
    $noRestrictFiles = ['index.php', 'login.php', 'about.php', 'logout.php', 'register.php', 'forgotPassword.php', 'resetPassword.php', 'test.php'];
    if (isset($_SESSION) && !empty($_SESSION)) {
        $commonFiles = ['profile.php'];
        switch ($_SESSION['curUser']['position']) {
            case 'editor': {
                    $AllowedFiles = ['listPublication.php', 'listReviewer.php', 'listHardcopy.php', 'listManuscript.php', 'assignTask.php', 'addCategory.php', 'manuscriptApproval.php', 'listCategory.php', 'addCategory.php'];
                    break;
                }
            case 'author': {
                    $AllowedFiles = ['listManuscript.php', 'manuscriptSubmission.php', 'payment.php', 'manuscriptStatus.php', 'resubmitManuscript.php'];
                    break;
                }
            case 'reviewer': {
                    $AllowedFiles = ['pendingReviewList.php', 'reviewManuscript.php', 'listReview.php'];
                    break;
                }
        }
    }
    return in_array(basename($_SERVER['PHP_SELF']), array_merge($commonFiles, $AllowedFiles, $noRestrictFiles));
}

//https://phppot.com/php/user-login-session-timeout-logout-in-php/
if (isset($_SESSION["curUser"]) && isset($_SESSION['loggedIn_time'])) {
    //set redirect for timeout or invalid file permission
    $session_duration = 60 * 60; //in seconds
    $timeDiff = time() - $_SESSION['loggedIn_time'];
    //if its logged in 
    if ($timeDiff < $session_duration) {
        //if in login or register redirect
        if (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'register.php') {
            header("Location:profile.php");
            exit;
        } else {
            checkFilePermission() ? '' : header("Location:profile.php");
        }
    } else {
        sleep(2);
        header("Location:logout.php?session_expired=1");
    }
} else {
    checkFilePermission() ? '' : header("Location:login.php");
}
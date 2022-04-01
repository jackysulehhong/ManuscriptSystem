<?php
function getStatusMessage($status)
{
 $message = "";
 switch ($status) {
  case 'pendingManuscriptApproval': {
    $message = 'Pending Manuscript Approval';
    break;
   }
  case 'approve': {
    $message = 'Approved';
    break;
   }
  case 'reject': {
    $message = 'Rejected';
    break;
   }
  case 'pendingAssign': {
    $message = 'Waiting for Assign Reviewer';
    break;
   }
  case 'pendingReview': {
    $message = 'Waiting for Review';
    break;
   }
  case 'pendingReviewApproval': {
    $message = 'Waiting for Review Approval';
    break;
   }
  case 'pendingResubmit': {
    $message = 'Waiting for Resubmit';
    break;
   }
  case 'pendingResubmitApproval': {
    $message = 'Waiting for Resubmit Approval';
    break;
   }

  case 'pendingPayment': {
    $message = 'Waiting for Payment';
    break;
   }
  case 'pendingPublish': {
    $message = 'Waiting for Publish';
    break;
   }
  case 'publish': {
    $message = 'Published';
    break;
   }
  case 'pending': {
    $message = 'Pending';
    break;
   }
  case 'complete': {
    $message = 'Completed Review';
    break;
   }
  default: {
    $message = 'Unknown status';
    break;
   }
 }

 return $message;
}
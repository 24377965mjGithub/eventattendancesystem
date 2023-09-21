<?php

function timeAgo($time){
    $diff = time() - $time;

    $sec = $diff;
    $min = round($diff / 60);
    $hrs = round($diff / 3600);
    $days = round($diff / 86400);
    $weeks = round($diff / 604800);
    $mnths = round($diff / 2600640);
    $yrs = round($diff / 31207680);

    if ($sec <= 60){
        if ($sec == 1){
            return "1 second ago";
        } else {
            return "$sec seconds ago";
        }
    }
    else if ($min <= 60) {
        if ($min == 1){
            return "1 minute ago";
        } else {
            return "$min minutes ago";
        }
    }
    else if ($hrs <= 24) {
        if ($hrs == 1){
            return "1 hour ago";
        } else {
            return "$hrs hours ago";
        }
    }
    else if ($days <= 7) {
        if ($days == 1){
            return "1 day ago";
        } else {
            return "$days days ago";
        }
    }
    else if ($weeks <= 4.3) {
        if ($weeks == 1){
            return "1 week ago";
        } else {
            return "$weeks weeks ago";
        }
    }
    else if ($mnths <= 12) {
        if ($mnths == 1){
            return "1 month ago";
        } else {
            return "$mnths months ago";
        }
    }
    else {
        if ($yrs == 1){
            return "1 year ago";
        } else {
            return "$yrs years ago";
        }
    }
}
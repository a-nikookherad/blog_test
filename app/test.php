<?php

$consultations = Consultation::query()
    ->whereHas("consultationTime", function ($query) {
        $query->whereNotNull("deleted_at");
    })
    ->with("consultationTime")
    ->get();

foreach ($consultations as $consultationInstance) {
    $consultationTimeInstance = ConsultationTime::query()
        ->where("time", $consultationInstance->consultationTime->time)
        ->where("week_day", $consultationInstance->consultationTime->week_day)
        ->first();
    if ($consultationInstance instanceof ConsultationTime) {
        $consultationInstance->consultation_time_id = $consultationTimeInstance->id;
        $consultationInstance->save();
    }
}

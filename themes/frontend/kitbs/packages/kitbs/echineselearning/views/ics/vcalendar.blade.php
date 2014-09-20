BEGIN:VCALENDAR
VERSION:2.0
PRODID:kitbs
CALSCALE:GREGORIAN
METHOD:PUBLISH
@if ($lastDate)
BEGIN:VEVENT
UID:{{ md5($lastDate).'@kitbs.com' }}
DTSTART;VALUE=DATE:{{ $lastDate->setTimezone('UTC')->format('Ymd') }}
DTEND;VALUE=DATE:{{ $lastDate->setTimezone('UTC')->format('Ymd') }}
DESCRIPTION:预订期最后一天
SUMMARY:预订期最后一天
END:VEVENT
@endif
@if ($reminder)
BEGIN:VEVENT
UID:{{ md5($reminder).'@kitbs.com' }}
DTSTART:{{ $reminder->setTimezone('UTC')->format('Ymd\THis\Z') }}
DTEND:{{ $reminder->setTimezone('UTC')->addHour()->format('Ymd\THis\Z') }}
DESCRIPTION:最后一节课：{{ $lastLesson->format('Y年m月d日') }}
SUMMARY:预定课
END:VEVENT
@endif
@foreach ($lessons as $lesson)
BEGIN:VEVENT
UID:{{ $lesson->uid }}
DTSTART:{{ $lesson->lesson_at->setTimezone('UTC')->format('Ymd\THis\Z') }}
DTEND:{{ $lesson->lesson_at->setTimezone('UTC')->addHour()->format('Ymd\THis\Z') }}
DESCRIPTION:{{ $lesson->description }}
SUMMARY:{{ $lesson->summary }}
END:VEVENT
@endforeach
@foreach ($suspensions as $suspension)
BEGIN:VEVENT
UID:{{ $suspension->uid }}
DTSTART;VALUE=DATE:{{ $suspension->start_at->setTimezone('UTC')->format('Ymd') }}
DTEND;VALUE=DATE:{{ $suspension->end_at->setTimezone('UTC')->format('Ymd') }}
DESCRIPTION:{{ $suspension->description }}
SUMMARY:{{ $suspension->summary }}
END:VEVENT
@endforeach
END:VCALENDAR
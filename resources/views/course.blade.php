@php
    $names = ['first' => 'الاول', 'second' => 'الثاني', 'third' => 'الثالث', 'fourth' => 'الرابع'];
    $types = [1 => 'تدريب وامتحان', 'امتحان فقط'];
    $majorsArray = [];
    foreach ($majors as $major) {
        $majorsArray[$major->id] = $major->name;
    }
    $resident = [ 1 => 'داخل عدن','خارج عدن'];
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl" class=" font-primary">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الامتحان</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('includes.header')
    <h1 class="text-5xl font-semibold px-5 lg:px-10 py-8 border-b-4 p-3 bg-sky-400 border-sky-400 text-white pt-12">
        التسجيل للامتحان الدولي</h1>
    <section class="px-5 lg:px-10 my-8">
        <form action="{{route('course.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <x-input type="radio" required id="type" name="type" :choices="$types" note="يتحمل الطالب رسوم الدورة في حال تسجيله في مسار االمتحانات فقط, ثم رغبته بااللتحاق بدورة تدريبية">نوع التسجيل</x-input>
            <x-input name="courseNumber" required id="CN">رقم الدورة</x-input>
            <x-input type="file" required name="passport" id="PP">صورة جواز السفر</x-input>
            <x-input type="file" required name="card" id="CC">صورة البطاقة الجامعية</x-input>
            <x-input id="names" name="ARname" required :fields="$names" note="ادرج اللقب مع الاسم الرابع إن وجد">الاسم الرباعي</x-input>
            <x-input id="names" name="ENname" required :fields="$names" note="ادرج اللقب مع الاسم الرابع إن وجد">الاسم الرباعي بالانجليزي</x-input>
            <x-input type="radio" required name="major" id="major" :choices="$majorsArray">التخصص</x-input>
            <x-input type="date" required name="Bday" id="BD">تاريخ الميلاد</x-input>
            <x-input type="radio" required name="resident" id="R" :choices="$resident">مكان الاقامة</x-input>
            <x-input name="phone" required id="phone">رقم الهاتف</x-input>
            <x-input type="radio" required name="sex" id="sex" :choices="[ 1 => 'ذكر','انثى']">الجنس</x-input>
            <x-input type="radio" required name="lang" id="lang" :choices="[ 1 => 'عربي','انجليزي']">لغة الامتحان</x-input>
            <x-input type="radio" required name="exam" id="exam" :choices="[ 1 => 'Start','ICDL Certificate']" note="علي كافة التخصصات اختيار Start بستثناء تقنية المعلومات ونظم المعلومات والكرافيكس والامن السيبراني للمزيد من المعلومات اقراء السياسات والقوانين في الاسفل">نوع الامتحان</x-input>
            <p class=" my-4 text-lg text-slate-700">هل توافق على كافة <a href="" class="text-sky-400 underline underline-offset-2">الشروط والقوانين</a></p>
            <x-form.checkbox name="agree" required id="A">اوافق</x-form.checkbox>
            <x-input type="button" class="m-8">تسجيل</x-input>

    </section>
    @include('includes.footer')
</body>

</html>

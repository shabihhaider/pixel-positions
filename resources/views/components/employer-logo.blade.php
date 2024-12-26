@props(['employer', 'width' => 90])
<img src="{{ asset($employer->logo) }}" alt="" class="rounded-xl" width="{{ $width }}">
<!-- it will go and look for the logo in the storage/app/public/logos -->
<!-- For accessing the logo in public, we have to run this command 'php artisan storage:link' -->
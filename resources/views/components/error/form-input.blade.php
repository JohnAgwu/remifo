@props(['inputName'])
@error($inputName)

    <span class="text-danger">{{ $message }}</span>

@enderror

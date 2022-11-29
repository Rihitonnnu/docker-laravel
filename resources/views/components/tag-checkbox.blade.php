@props(['value','id','isChecked'=>false,'name'])
<div class="flex mt-2">
    <input type="checkbox" id="tags" name="tags[]"
        class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 mt-2" value="{{ $id }}"
        @if($isChecked || (is_array(old('tags')) && in_array($id, old('tags')))) checked @endif />
    <label for="checkbox"
        class="pt-2 ml-1 mr-3 w-full text-sm text-gray-900 dark:text-gray-300">{{ $name }}</label>
</div>

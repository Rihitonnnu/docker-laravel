@props(['id','name','content'=>null])
<textarea id={{ $id }} name={{ $name }} class="w-full h-72 whitespace-pre-wrap bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $content }}</textarea>

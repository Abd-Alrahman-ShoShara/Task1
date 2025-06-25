@extends('layouts.app')

@section('title', 'مهامي')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-center">قائمة المهام</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700">
                <tr class="text-right">
                    <th class="py-3 px-4">العنوان</th>
                    <th class="py-3 px-4">التفاصيل</th>
                    <th class="py-3 px-4">التصنيفات</th>
                    <th class="py-3 px-4">مكتملة؟</th>
                    <th class="py-3 px-4">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($tasks as $task)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $task->title }}</td>
                        <td class="py-3 px-4">{{ $task->description }}</td>
                        <td class="py-3 px-4">
                            @foreach($task->categories as $category)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="py-3 px-4">
                            @if($task->is_completed)
                                <span class="text-green-600 font-semibold">نعم</span>
                            @else
                                <span class="text-red-600 font-semibold">لا</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 flex space-x-2 justify-end">
                            <!-- تعديل -->
                            <a href="{{ route('tasks.edit', $task->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">تعديل</a>

                            <!-- حذف -->
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($tasks->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">لا توجد مهام بعد</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

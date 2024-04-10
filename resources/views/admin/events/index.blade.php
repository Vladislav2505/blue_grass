@extends('layouts.admin')
@section('title', 'Мероприятия')
@section('content')

    <div class="font-medium text-4xl mb-10 md:mb-4 mx-auto text-left">
        <h2>Мероприятия</h2>
    </div>

    <div class="flex flex-col gap-4">
        <div class="flex justify-end">
            <x-admin.button button-label="Добавить мероприятие"/>
        </div>

        <div class="border border-[#d1d5db] rounded-[5px] overflow-x-auto overflow-y-hidden">
            <table class="table-auto w-full whitespace-nowrap max-w-none">
                <thead class="border-b border-[#d1d5db]">
                <tr class="text-left">
                    <th class="px-6 py-2">Last Name</th>
                    <th class="px-6 py-2">First Name</th>
                    <th class="px-6 py-2">Patronymic</th>
                    <th class="px-6 py-2">Email</th>
                    <th class="px-6 py-2">Created At</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-2">{{ $user->last_name }}</td>
                        <td class="px-6 py-2">{{ $user->first_name }}</td>
                        <td class="px-6 py-2">{{ $user->patronymic ?? '-' }}</td>
                        <td class="px-6 py-2">{{ $user->email }}</td>
                        <td class="px-6 py-2">{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->onEachSide(2)->links()}}
    </div>

@endsection

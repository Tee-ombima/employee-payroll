<div class="bg-white shadow rounded-lg p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $title }}</h1>
    
    <form action="{{ $action }}" method="POST">
        @csrf
        @if(isset($deduction))
            @method('PUT')
        @endif
        
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Deduction Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $deduction->name ?? '') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount', $deduction->amount ?? '') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" id="is_percentage" name="is_percentage" value="1" 
                    @if(old('is_percentage', $deduction->is_percentage ?? false)) checked @endif
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <label for="is_percentage" class="ml-2 block text-sm text-gray-700">Is Percentage</label>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('deductions.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ $buttonText }}
            </button>
        </div>
    </form>
</div>
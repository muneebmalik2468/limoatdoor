<div>
    <!-- Feedback Button -->
    <button 
        wire:click="toggleForm" 
        class="fixed bottom-6 right-6 bg-blue-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-700 transition z-50 font-semibold">
        Feedback
        <span wire:loading wire:target="toggleForm" class="animate-spin h-5 w-5 inline-block ml-2">⏳</span>
    </button>

    <!-- Feedback Form -->
    @if ($showForm)
        <div wire:ignore.self class="fixed bottom-20 right-6 bg-white shadow-xl rounded-lg p-4 w-80 border z-50">
            @if ($submitted)
                <p class="text-green-600 font-semibold">Thanks for your feedback!</p>
            @else
                <h3 class="font-bold mb-2">Rate your experience</h3>

                <!-- Star Rating -->
                <div class="flex mb-3 space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" name="rating" value="{{ $i }}" wire:model.lazy="rating" class="hidden" id="star{{ $i }}">
                        <label for="star{{ $i }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 cursor-pointer {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.784.57-1.838-.197-1.539-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z" />
                            </svg>
                        </label>
                    @endfor
                </div>

                <!-- Message Field -->
                <textarea wire:model.defer="message"
                          class="w-full p-2 border rounded text-sm resize-none"
                          rows="3" placeholder="Optional message..."></textarea>

                @error('rating') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                @error('message') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror

                <!-- Submit Button -->
                <button wire:click="submit"
                        class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
                    Submit
                    <span wire:loading wire:target="submit" class="animate-spin h-5 w-5 inline-block ml-2">⏳</span>
                </button>
            @endif
        </div>
    @endif
</div>
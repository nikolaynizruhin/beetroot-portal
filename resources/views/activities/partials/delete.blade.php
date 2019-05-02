@admin
    <form id="delete-form"
          class="d-inline"
          method="POST"
          action="{{ route('activities.destroy', $activity) }}">
        @method('DELETE')
        @csrf

        <!-- Delete Button -->
        <button type="submit"
                class="close text-danger"
                aria-label="Close"
                onclick="event.preventDefault();
                        if (confirm('Are you sure you want to delete an activity?'))
                        document.getElementById('delete-form').submit();">
            <span aria-hidden="true">&times;</span>
        </button>
    </form>
@endadmin
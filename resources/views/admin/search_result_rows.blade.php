@if ($students->isEmpty())
    <tr>
        <td colspan="12" class="text-center"><strong>No Results Found.</strong></td>
    </tr>
@else
    @foreach ($students as $student)
        @foreach ($student->results as $index => $result)
            <tr>
                @if ($index === 0)
                    <td rowspan="{{ count($student->results) }}">{{ $student->appNo }}</td>
                    <td rowspan="{{ count($student->results) }}">{{ $student->name }}</td>
                    <td rowspan="{{ count($student->results) }}">{{ $student->email }}</td>
                    <td rowspan="{{ count($student->results) }}">{{ $student->phone }}</td>
                    <td rowspan="{{ count($student->results) }}">{{ $student->its }}</td>
                @endif
                <td>{{ $result->semester }}</td>
                <td>{{ number_format($result->gpa, 2) }}</td>
                <td>{{ number_format($result->cgpa, 2) }}</td>
                <td>
                    @if (isset($result->resultFile))
                        <a href="{{ asset('storage/results/' . $result->resultFile) }}" target="_blank"
                            class="btn btn-primary btn-sm">View Result</a>
                    @else
                        No result file
                    @endif
                </td>
                <td>
                    @if (isset($result->feesFile))
                        <a href="{{ asset('storage/Challan/' . $result->feesFile) }}" target="_blank"
                            class="btn btn-secondary btn-sm">View Fees Challan</a>
                    @else
                        No Challan file
                    @endif
                </td>
                <td>
                    <form action="{{ route('save.remarks', $result->id) }}" method="POST">
                        @csrf
                        <textarea class="form-control remarks-textarea" name="remarks" rows="2" placeholder="Enter remarks">{{ $result->remarks ?? '' }}</textarea>
                        <button type="submit" class="btn btn-success btn-sm">Send</button>
                    </form>
                </td>
                @if ($index === 0)
                    <td rowspan="{{ count($student->results) }}">
                        <form action="{{ route('admin.destroy', $student->appNo) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this student?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    @endforeach
@endif

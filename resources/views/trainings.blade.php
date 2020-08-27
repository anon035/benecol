@extends('layouts.base', ['title' => 'Tréningy'])

@section('content')

<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content responsive-event-center">
            <div id="all" class="tab-pane fade in active">
                <table>
                    <tr>
                        <td colspan="2">Kategória</td>
                        @foreach ($days as $day)
                        <td>
                            {{ $day }}
                        </td>
                        @endforeach
                    </tr>
                    @foreach ($categories as $name => $category)
                    <tr>
                        <td colspan="2">{{ $name }}</td>
                        @foreach ($category['week'] as $training) <td>
                            {{ $training ? $training->event_date->isoFormat('H:mm') : ' - ' }}
                            @if ($training && $training->note)
                            <i class="fa fa-info-circle">
                                <span class="note-tooltip">{{ $training->note }}</span>
                            </i>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let icons = document.querySelectorAll(".fa-info-circle");
    for(icon of icons){
            let tooltip = icon.querySelector(".note-tooltip");
            icon.addEventListener("mouseover", () => {
                tooltip.style.display = "block";
            });
            icon.addEventListener("mouseout", () => {
                tooltip.style.display = "none";
            });

            document.querySelector("table").addEventListener("click", (e) => {
                if(e.target.nodeName != "SPAN" && e.target.nodeName != "I"){
                    tooltip.style.display = "none";
                }
            });
        }
</script>
@endpush
@endsection
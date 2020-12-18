<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="moveAttendance-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close "><svg viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></i>
                </button>
                <p class="modal-headerTools-title">Collect RSVPs</p>
            </div>
            <div class="tools-header-bar">Select a Status :</div>
            <form class="app-guest-multi-form" onsubmit="return moveToAttendance();" action="{{url('tools/moveToAttendance')}}" method="post">
                @csrf
                <div class="modal-body  p25 pt10 pb10 ">
                    <div class="alert alert-error dnone moveAttendanceErr" role="alert" aria-hidden="true">
                        <p>It was not possible to save your changes. Please try again later.</p>
                    </div>
                    <ul class="list-items list-items-content">
                        <li class="selectAll_li attendance_li" data-value="Pending">
                            <div class="iradio_minimal" style="position:relative;">
                                <input type="radio" name="attendance" style="opacity:0;">
                            </div>
                            <label>Pending</label>
                        </li>
                        <li class="selectAll_li attendance_li" data-value="Confirmed">
                            <div class="iradio_minimal" style="position:relative;">
                                <input type="radio" name="attendance" style="opacity:0;">
                            </div>
                            <label>Confirmed</label>
                        </li>
                        <li class="selectAll_li attendance_li" data-value="Cancelled">
                            <div class="iradio_minimal" style="position:relative;">
                                <input type="radio" name="attendance" style="opacity:0;">
                            </div>
                            <label>Cancelled</label>
                        </li>
                    </ul>
                </div>
                <div class="border-top p20 pl25 pr25 pure-g">
                    <input type="hidden" name="attendanceId" id="attendanceId">
                    <input type="hidden" name="idEvent" id="idEvent" value="{{$idEvent}}">
                    <input type="hidden" name="attendanceGuestsId" id="attendanceGuestsId">
                    <div class="pure-u-2-3">
                        <div class="app-guest-multi-detail" style="display:none;">You are moving <strong><span class="modal-guest-num"></span> guest</strong> to <strong><span class="modal-change-name"></span></strong></div>
                    </div>
                    <div class="pure-u-1-3 text-right">
                        <input type="submit" class="btn-flat red" value="Change">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
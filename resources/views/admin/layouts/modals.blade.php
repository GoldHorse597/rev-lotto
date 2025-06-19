<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin/app.will_you_logout')</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">@lang('admin/app.you_should_login_again_after_logout')</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
				<form class="d-none" id="logout" method="POST" action="{{route('admin.logout')}}">@csrf</form>
				<button class="btn btn-primary" onclick="document.querySelector('#logout').submit()">@lang('admin/app.logout')</button>
			</div>
		</div>
	</div>
</div>

<!-- Password Change Modal-->
<div class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{route('admin.agent.changepassword')}}" method="post">
                @method('PATCH')
                @csrf
				<div class="modal-header">
					<h5 class="modal-title">@lang('admin/app.change_password')</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="old-password">@lang('admin/app.current_password')</label>
                        <div>
                            <input type="password" class="form-control " id="old-password" name="old_password"
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.password')) }}">
                        </div>
					</div>
					<div class="form-group">
						<label for="new-password">@lang('admin/app.new_password')</label>
                        <div>
                            <input type="password" class="form-control " id="new-password" name="new_password"
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.new_password')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.new_password'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.new_password'), 255) }}">
                        </div>
					</div>
					<div class="form-group">
						<label for="new-password-confirmation">@lang('admin/app.new_password_confirm')</label>
                        <div>
                            <input type="password" class="form-control " id="new-password-confirmation" name="new_password_confirmation"
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.new_password_confirm')) }}"
                                    data-rule-equalto="#new-password" data-msg-equalto="{{ sprintf(trans('admin/app.mismatch'), trans('admin/app.new_password_confirm')) }}">
                        </div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
					<button class="btn btn-primary" type="submit">@lang('admin/app.change')</button>
				</div>
			</form>
		</div>
	</div>
</div>

@if (Auth::guard('admin')->user()->parent_level < env('AGENT_DEPTH'))
<!-- Agent Create Modal -->
<div class="modal fade" id="agentCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('admin.agent.create') }}" method="post">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">@lang('admin/app.new_agent')</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label for="agentParentId" class="col-sm-4 col-form-label">@lang('admin/app.parent_agent')</label>
						<div class="col-sm-8">
							<select class="form-control" id="agentParentId" name="parent_id" required="" tabindex="-1" aria-hidden="true">
								<option value="{{ Auth::guard('admin')->user()->id }}" selected> {{ Auth::guard('admin')->user()->nickname }} ({{ '@'.Auth::guard('admin')->user()->identity }}) </option>
                                @foreach($_agents as $index => $agent)
                                <option value="{{ $agent->id }}" class="l{{ $agent->parent_level }}"> {{ $agent->nickname }} ({{ '@'.$agent->identity }}) </option>
                                @endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="identity" class="col-sm-4 col-form-label">@lang('admin/app.identity')</label>
						<div class="col-sm-8">
							<input type="text" class="form-control " id="identity" name="identity" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.identity')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.identity'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.identity'), 255) }}">
						</div>
					</div>
					<div class="form-group row">
						<label for="nickname" class="col-sm-4 col-form-label">@lang('admin/app.nickname')</label>
						<div class="col-sm-8">
							<input type="text" class="form-control " id="nickname" name="nickname" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.nickname')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.nickname'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.nickname'), 255) }}">
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-sm-4 col-form-label">@lang('admin/app.password')</label>
						<div class="col-sm-8">
							<input type="password" class="form-control " id="password" name="password" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.password')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.password'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.password'), 255) }}">
						</div>
					</div>
					<div class="form-group row" hidden>
						<label for="type" class="col-sm-4 col-form-label">@lang('admin/app.type')</label>
						<div class="col-sm-8">
							<select class="form-control " id="type" name="type" data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.type')) }}">
								<option value="">@lang('admin/app.choose_type')</option>
								@if (Auth::guard('admin')->user()->parent_level == 0 || Auth::guard('admin')->user()->type == 0)
								<option value="0">@lang('admin/app.online_agent')</option>
								@endif
								@if (Auth::guard('admin')->user()->parent_level == 0 || Auth::guard('admin')->user()->type == 1)
								<option value="1">@lang('admin/app.offline_agent')</option>
								@endif
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="siteId" class="col-sm-4 col-form-label">@lang('admin/app.site')</label>
						<div class="col-sm-8">
							<select class="form-control" id="siteId" name="site_id[]" data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.site')) }}" multiple>
								@foreach ($_sites as $site)
								<option value="{{$site->id}}">{{$site->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="memo" class="col-sm-4 col-form-label">@lang('admin/app.memo')</label>
						<div class="col-sm-8">
							<textarea class="form-control " id="memo" name="memo" rows="5"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
					<button class="btn btn-success" type="submit">@lang('admin/app.create')</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endif

<!-- User Create Modal -->
<div class="modal fade" id="userCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('admin.user.create') }}" method="post">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">@lang('admin/app.new_user')</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					
					<div class="form-group row">
						<label for="identity" class="col-sm-4 col-form-label">@lang('admin/app.identity')</label>
						<div class="col-sm-8">
							<input type="text" class="form-control " id="identity" name="identity" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.identity')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.identity'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.identity'), 255) }}">
						</div>
					</div>
					<div class="form-group row">
						<label for="nickname" class="col-sm-4 col-form-label">@lang('admin/app.nickname')</label>
						<div class="col-sm-8">
							<input type="text" class="form-control " id="nickname" name="nickname" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.nickname')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.nickname'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.nickname'), 255) }}">
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-sm-4 col-form-label">@lang('admin/app.password')</label>
						<div class="col-sm-8">
							<input type="password" class="form-control " id="password" name="password" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.password')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.password'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.password'), 255) }}">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="siteIdentity" class="col-sm-4 col-form-label">@lang('admin/app.site') @lang('admin/app.identity')</label>
						<div class="col-sm-8">
							<div class="input-group ">
								<input type="text" class="form-control" id="siteIdentity" name="site_identity" value=""
									data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.identity')) }}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="memo" class="col-sm-4 col-form-label">@lang('admin/app.memo')</label>
						<div class="col-sm-8">
							<textarea class="form-control" id="memo" name="memo" rows="5"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
					<button class="btn btn-success" type="submit">@lang('admin/app.create')</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="codeCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('admin.code.create') }}" method="post">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">추천코드 생성</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">					
					<div class="form-group row">
						<label for="code" class="col-sm-4 col-form-label">추천코드</label>
						<div class="col-sm-8">
							<input type="text" class="form-control " id="code" name="code" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.identity')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.identity'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.identity'), 255) }}">
						</div>
					</div>								
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
					<button class="btn btn-success" type="submit">@lang('admin/app.create')</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="bankCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('admin.bank.create') }}" method="post">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">은행 생성</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">					
					<div class="form-group row">
						<label for="code" class="col-sm-4 col-form-label">은행명</label>
						<div class="col-sm-8">
							<input type="text" class="form-control " id="bank" name="name" value=""
                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.identity')) }}"
                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.identity'), 4) }}"
                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.identity'), 255) }}">
						</div>
					</div>								
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
					<button class="btn btn-success" type="submit">@lang('admin/app.create')</button>
				</div>
			</form>
		</div>
	</div>
</div>

@if (Auth::guard('admin')->user()->parent_level == 0)
<!-- User & Agent Send Message Modal -->
<div class="modal fade" id="sendMessageModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin/app.new_message')</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{route('admin.message.send')}}" id="messageForm">
				@csrf
				<div class="modal-body">
					<div class="form-group row">
						<label for="messageReceiverType" class="col-sm-4 col-form-label">@lang('admin/app.receiver')</label>
						<div class="col-sm-8">
							<div class="input-group ">
								<select class="form-control" id="messageReceiverType" name="receiver_type"
									data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.receiver')) }}">
									<option value="" selected="selected">선택하세요.</option>
									<option value="all">@lang('admin/app.all')</option>
									<option value="users">@lang('admin/app.user')</option>
									<option value="agents">@lang('admin/app.agent')</option>
									<option value="agents_1">@lang('admin/agent.level2')</option>
									<option value="agents_2">@lang('admin/agent.level3')</option>
									<option value="agents_3">@lang('admin/agent.level4')</option>
								</select>
								<input type="text" class="form-control" id="messageReceiverIdentity" name="receiver_identity" value="" placeholder="@lang('admin/app.identity')" hidden>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="messageTitle" class="col-sm-4 col-form-label">@lang('admin/app.subject')</label>
						<div class="col-sm-8">
							<div class="input-group ">
								<input type="text" class="form-control" id="messageTitle" name="title" value=""
									data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.subject')) }}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="messageContent" class="col-sm-4 col-form-label">@lang('admin/app.content')</label>
						<div class="col-sm-8">
							<div class="input-group ">
								<textarea class="rich-textarea form-control" id="messageContent" name="content" rows="10"
									data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.content')) }}"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
					<button class="btn btn-success" type="submit">@lang('admin/app.send')</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endif

@section('script')
    @parent
    <script>
		var config = {
			routes: {
				tick: '{{ route('admin.tick') }}',
				logout: '{{ route('admin.logout') }}',
			}
		};
        $(function() {
            $("#agentCreateModal select#agentParentId").select2ToTree({
                theme: 'bootstrap4',
                width: 'element',
                dropdownParent: $('#agentCreateModal')
            });

			$("#agentCreateModal select#siteId").select2({
                width: '100%'
            });

            $("#userCreateModal select#userParentId").select2ToTree({
                theme: 'bootstrap4',
                width: 'element',
                dropdownParent: $('#userCreateModal')
            });

			$('#sendMessageModal').on('shown.bs.modal', function({
                relatedTarget: target
            }) {
                let $modal = $("#sendMessageModal");
				let type = $(target).data('type');
                let identity = $(target).data('identity');
				if (type == '0') {
					$("#messageReceiverType").val('agents').change();
				}
				else if (type == '1') {
					$("#messageReceiverType").val('users').change();
				}
				$("#messageReceiverIdentity").val(identity);
            });

			$('#messageReceiverType').on('change', function() {
				let type = $(this).val();
				if (type == 'all')
					$("#messageReceiverIdentity").prop('hidden', true);
				else
					$("#messageReceiverIdentity").prop('hidden', false);
			});

			$(document).on('submit', '#messageForm', function(e) {
				e.preventDefault();
				var messageReceiverType = $(this).find('#messageReceiverType').val();
				var messageReceiverIdentity = $(this).find('#messageReceiverIdentity').val();
				var messageTitle = $(this).find('#messageTitle').val();
				var messageContent = $(this).find('#messageContent').val();
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					data: {
						receiver_type: messageReceiverType,
						receiver_identity: messageReceiverIdentity,
						title: messageTitle,
						content: messageContent
					},
					dataType: 'json',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function (data) {
						if (data.success) {
							alertify.alert('', data.msg);
							window.location.reload();
						}
						else {
							if (data.msg)
								alertify.alert('오류', data.msg);
						}
					},
					error: function(error) {
						console.log(error);
					},
					complete : function() {
					}
				});
			});
        });
    </script>
@endsection

@extends('admin.index')

@section('title', 'Setting')
@section('content')

<div class="row">
    <div class="col-md-12 grid margin">

        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <form action="{{ url('admin/settings') }}" method="POST">
            @csrf

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Website Name</label>
                            <input type="text" name="website_name" value="{{ $setting->website_name ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website Url</label>
                            <input type="text" name="website_url" value="{{ $setting->website_url ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Page Title</label>
                            <input type="text" name="page_title" value="{{ $setting->page_title ?? '' }}" class="form-control" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ $setting->meta_keywords ?? '' }}" class="form-control" rows="3" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ $setting->meta_description ?? ''}}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website-Information</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Website Email 1</label>
                            <input type="text" name="email1" value="{{ $setting->email1 ?? '' }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website Email 2</label>
                            <input type="text" name="email2" value="{{ $setting->email2 ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website Phone 1</label>
                            <input type="text" name="phone1" value="{{ $setting->phone1 ?? '' }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website Phone 2</label>
                            <input type="text" name="phone2" value="{{ $setting->phone2 ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Address</label>
                            <textarea name="addresss"  class="form-control" rows="3">{{ $setting->addresss ?? ''}}</textarea>
                        </div>



                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website- Social Media</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Facebook (Optional)</label>
                            <input type="text" name="facebook"  value="{{ $setting->facebook ?? '' }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Twitter (Optional)</label>
                            <input type="text" name="twitter" value="{{ $setting->twitter ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Instagram (Optional)</label>
                            <input type="text" name="instagram"  value="{{ $setting->instagram ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>YouTube (Optional)</label>
                            <input type="text" name="youtube"  value="{{ $setting->youtube }}" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website- About Us</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>About Us Title</label>
                            <input type="text" name="about_us_title"  value="{{ $setting->about_us_title ?? '' }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>About Us Description</label>
                            <input type="text" name="about_us_description" value="{{ $setting->about_us_description ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Company Total Exp</label>
                            <input type="text" name="company_exp"  value="{{ $setting->company_exp ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Total Happy Paitent </label>
                            <input type="text" name="happy_paitent"  value="{{ $setting->happy_paitent }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Total Doctors </label>
                            <input type="text" name="specialist_doctors"  value="{{ $setting->specialist_doctors }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Total Hospital</label>
                            <input type="text" name="specialist_hospital"  value="{{ $setting->specialist_hospital }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Total Pathology </label>
                            <input type="text" name="specialist_pathology"  value="{{ $setting->specialist_pathology }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Total Ambulance </label>
                            <input type="text" name="ambulance"  value="{{ $setting->ambulance }}" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white ">Save Setting</button>
            </div>
        </form>
    </div>
</div>
@endsection

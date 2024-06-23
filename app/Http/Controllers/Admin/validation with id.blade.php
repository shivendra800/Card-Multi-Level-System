protected $rules_update = [
    'email_address' => 'required|email|unique:users,email_address,'.$id,
    'first_name' => "required",
    'last_name' => "required",
    'password' => "required|min:6|same:password_confirm",
    'password_confirm' => "required:min:6|same:password",
    'password_current' => "required:min:6"
];
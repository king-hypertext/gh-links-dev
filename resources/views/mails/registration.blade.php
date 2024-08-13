<h2 style="background-color: #262626; text-align: center;">
    Your Account Has Been Created Successfully!
</h2>
<p>
    Hello {{ $user->username }},
</p>
<p>
    Your account has been created successfully. Please click the button below to verify your email.
</p>
<p style="text-align: center;">
    <a href=""
        style="background-color: #3b71ca;color: #fff;text-decoration: none;text-align: center;    vertical-align: middle;    cursor: pointer;    user-select: none;border-radius: 0.25rem;border: 1px solid transparent">
        Verify Your Email
    </a>
</p>
<h6 style="text-align: center;">OR</h6>
<p>
    Copy and paste the below link in your browser to verify your email address.
</p>
<p>
    If you did not request to create an account, please contact us at
    <a href="{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>.
</p>

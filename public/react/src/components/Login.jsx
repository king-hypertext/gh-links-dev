import React, { useState, useEffect } from 'react'
import DateTime from './DateTime'
import { Navigate } from 'react-router-dom'
import axiosRequest from './axios-request';
import { useStateContext } from './context/ContextProvider';
import { MDBBtn, MDBContainer, MDBInput, MDBCheckbox, MDBIcon, MDBCol } from 'mdb-react-ui-kit'
import './css/login.css';

function Login() {
    const { setUser, setToken, token, user } = useStateContext()
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        await axiosRequest.post('login', {
            username,
            password
        }).then(({ data }) => {
            console.log(data);
            setToken(data.token);
            setUser(data.user);
        });
    };
    console.log(token);
    // useEffect(() => {
    if (token !== null) {
        return <Navigate to={"/" + user?.username} state={user} />
    }
    // }, [user]);
    return (
        <>
            {/* <MDBContainer className="my-5 gradient-form">

                <MDBRow>

                    <MDBCol col='6' className="mb-5">
                        <div className="d-flex flex-column ms-5">

                            <div className="text-center">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                    style={{ width: '185px' }} alt="logo" />
                                <h4 className="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
                            </div>

                            <p>Please login to your account</p>


                            <MDBInput wrapperClass='mb-4' label='Email address' id='form1' type='email' />
                            <MDBInput wrapperClass='mb-4' label='Password' id='form2' type='password' />


                            <div className="text-center pt-1 mb-5 pb-1">
                                <MDBBtn className="mb-4 w-100 gradient-custom-2">Sign in</MDBBtn>
                                <a className="text-muted" href="#!">Forgot password?</a>
                            </div>

                            <div className="d-flex flex-row align-items-center justify-content-center pb-4 mb-4">
                                <p className="mb-0">Don't have an account?</p>
                                <MDBBtn outline className='mx-2' color='danger'>
                                    Danger
                                </MDBBtn>
                            </div>

                        </div>

                    </MDBCol>

                    <MDBCol col='6' className="mb-5">
                        <div className="d-flex flex-column  justify-content-center gradient-custom-2 h-100 mb-4">

                            <div className="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">We are more than just a company</h4>
                                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>

                        </div>

                    </MDBCol>

                </MDBRow>

            </MDBContainer> */}
            <MDBContainer className="px-5 pt-5 my-5 d-flex flex-column shadow" style={{ maxWidth: 500 + 'px' }}>
                <p className='mb-3'>
                    <h5 className="h5 text-uppercase text-center fw-semibold">gh links</h5>
                </p>
                <MDBInput wrapperClass='mb-4' label='Email address' id='form1' type='email' />
                <MDBInput wrapperClass='mb-4' label='Password' id='form2' type='password' />

                <div className="d-flex justify-content-between mx-3 mb-4">
                    <MDBCheckbox name='flexCheck' value='' id='flexCheckDefault' label='Remember me' />
                    <a href="!#">Forgot password?</a>
                </div>

                <MDBBtn className="mb-4">Sign in</MDBBtn>

                <div className="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                    <p className='mb-3 mt-5'>
                        <DateTime date time />
                    </p>
                    {/* <p>or sign up with:</p> */}

                    {/* <div className='d-flex justify-content-between mx-auto' style={{ width: '40%' }}>
                        <MDBBtn tag='a' color='none' className='m-1' style={{ color: '#1266f1' }}>
                            <MDBIcon fab icon='facebook-f' size="sm" />
                        </MDBBtn>

                        <MDBBtn tag='a' color='none' className='m-1' style={{ color: '#1266f1' }}>
                            <MDBIcon fab icon='twitter' size="sm" />
                        </MDBBtn>

                        <MDBBtn tag='a' color='none' className='m-1' style={{ color: '#1266f1' }}>
                            <MDBIcon fab icon='google' size="sm" />
                        </MDBBtn>

                        <MDBBtn tag='a' color='none' className='m-1' style={{ color: '#1266f1' }}>
                            <MDBIcon fab icon='github' size="sm" />
                        </MDBBtn>

                    </div> */}
                </div>

            </MDBContainer>
        </>
    )
}

export default Login

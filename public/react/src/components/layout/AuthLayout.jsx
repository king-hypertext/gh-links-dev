import React from 'react'
import { Outlet, Navigate } from 'react-router-dom'
import { useStateContext } from '../context/ContextProvider'

function AuthLayout() {
    
    const { token } = useStateContext();
    if (!token) {
        return <Navigate to="/login" />
    }
    return (
        <>
            <Outlet />
        </>
    )
}

export default AuthLayout

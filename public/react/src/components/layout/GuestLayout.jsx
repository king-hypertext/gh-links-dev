import React from 'react'
import { Outlet, Navigate } from 'react-router-dom'
import { useStateContext } from '../context/ContextProvider'
function GuestLayout() {
    const { token, user } = useStateContext()
    // debugger;
    if (token) {
        console.log(token);
        return <Navigate to={"/" + user?.username} />
    }
    return (
        <>
            <Outlet />
        </>
    )
}

export default GuestLayout

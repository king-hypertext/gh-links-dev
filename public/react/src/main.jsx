import React from 'react'
import ReactDOM from 'react-dom/client'
import 'mdb-react-ui-kit/dist/css/mdb.min.css'
import { Navigate, RouterProvider, createBrowserRouter } from 'react-router-dom'
import Login from './components/Login.jsx'
import AppLoader from './components/AppLoader.jsx'
import App from './App.jsx'
import Register from './components/Register.jsx'
import NotFound from './components/NotFound.jsx'
import ForgotPassword from './components/ForgotPassword.jsx'
import AuthLayout from './components/layout/AuthLayout.jsx'
import GuestLayout from './components/layout/GuestLayout.jsx'
import { ContextProvider } from './components/context/ContextProvider.jsx'


const routes = createBrowserRouter([
  {
    path: "/",
    element: <AuthLayout />,
    children: [
      // {
      //   path: '/',
      //   element: <Navigate to={'/:username'} />
      // },
      {
        path: "/:username",
        // loader:{({p})=>{}},
        element: <App />,
      },
    ]
  },
  {
    path: '/',
    element: <GuestLayout />,
    children: [
      {
        path: "login",
        element: <Login />,
        // action: 
      },
      {
        path: "register",
        element: <Register />
      },
      {
        path: "login/forgot-password",
        element: <ForgotPassword />
      }
    ]
  },
  {
    path: "*",
    element: <NotFound />,
  }
])
const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(
  <React.StrictMode>
    <ContextProvider>
      <RouterProvider router={routes} fallbackElement={<AppLoader />} />
    </ContextProvider>
  </React.StrictMode>,
);

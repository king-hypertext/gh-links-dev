import './App.css'
import Header from './components/Header'
import BottomNav from './components/BottomNav'
import { useNavigate } from 'react-router-dom'
import { Fragment, useEffect } from 'react'
import { useStateContext } from './components/context/ContextProvider'
import axiosRequest from './components/axios-request'
// import axiosRequest from './components/axios-request'

function App() {
  const { token } = useStateContext();
  const navigate = useNavigate();

  useEffect(() => {
    // navigate();
    console.log(token);
    if (!token) {
      return navigate('/login')
    }
  }, []);
  const logout = async (e) => {
    e.preventDefault();
    var confirmLogout = window.confirm('Are you sure you want to logout?')
    if (confirmLogout) {
      await axiosRequest.post("logout").then((res) => {
        console.log(res);
        localStorage.removeItem('AUTH_TOKEN');
      })
    }
  }
  return (
    <Fragment>
      <Header />
      <div className="container">
        <img src="#" alt="" srcSet={'image'} className='rounded-circle ' style={{
          width: '100%',
          maxWidth: '250px',
          height: '100%',
          maxHeight: '250px',
          backgroundColor: 'var(--bs-light)'
        }} />
      </div>
      <div className="">
        <button className="btn btn-danger" onClick={logout}>Logout</button>
      </div>
      <BottomNav />
    </Fragment>
  )
}

export default App

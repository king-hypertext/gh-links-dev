import React, { Fragment } from 'react'
import DateTime from './DateTime';
import { useStateContext } from './context/ContextProvider';
import axiosRequest from './axios-request';

function Header() {
  const { user, setUser } = useStateContext()
  // const [authUser, setAuthUser] = React.useState({})
  React.useEffect(() => {
    const fetchUser = async () => {
      await axiosRequest.get('profile').then(({ data }) => {
        console.log(data);
        setUser(data)
      });
    }
    fetchUser();

  }, []);

  return (
    <Fragment>
      <nav className="nav-wrapper shadow-sm">
        <h6 className="h6 fw-normal ">{user?.username}</h6>
        <div className="fw-light">
          <DateTime time date />
        </div>
      </nav>
    </Fragment>
  )
}

export default Header;

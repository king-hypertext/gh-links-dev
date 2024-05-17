import React, { Fragment } from 'react'

function BottomNav() {
    return (
        <Fragment>
            <div className='shadow-lg bottom-nav-wrapper'>
                <ul className="nav nav-fill nav-underline">
                    <li className="nav-item">
                        <a className="nav-link active " aria-current="page" href="#">
                            <i className="fas fa-user-alt"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="#">
                            <i className="fas fa-bars"></i>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="#">
                            <i className="fas fa-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </Fragment >
    )
}

export default BottomNav;

'use client'

import Link from 'next/link'
import { useAuth } from '@/hooks/auth'

const LoginLinks = () => {
    const { user } = useAuth({ middleware: 'guest' })

    return (
        <div className="">
            {user ? (
                <>
                    <nav className="navbar navbar-light">
                        <div className="container">
                            <a className="navbar-brand" href="/">
                                conduit
                            </a>
                            <ul className="nav navbar-nav pull-xs-right">
                                <li className="nav-item">
                                    {/* Add "active" class when you're on that page" */}
                                    <a className="nav-link active" href="/">
                                        Home
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a
                                        className="nav-link active"
                                        href="/editor">
                                        {' '}
                                        <i className="ion-compose" />
                                        &nbsp;New Article{' '}
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a
                                        className="nav-link active"
                                        href="/settings">
                                        {' '}
                                        <i className="ion-gear-a" />
                                        &nbsp;Settings{' '}
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a
                                        className="nav-link active"
                                        href="/dashboard">
                                        Dashboard
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </>
            ) : (
                <>
                    <nav className="navbar navbar-light">
                        <div className="container">
                            <a className="navbar-brand" href="/">
                                conduit
                            </a>
                            <ul className="nav navbar-nav pull-xs-right">
                                <li className="nav-item">
                                    {/* Add "active" class when you're on that page" */}
                                    <a className="nav-link active" href="/">
                                        Home
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link active" href="/login">
                                        Sign in
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link active" href="/register">
                                        Sign up
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </>
            )}
        </div>
    )
}

export default LoginLinks

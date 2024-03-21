import Link from 'next/link'
import AuthCard from '@/app/(auth)/AuthCard'
import ApplicationLogo from '@/components/ApplicationLogo'
import LoginLinks from '@/app/LoginLinks'

export const metadata = {
    title: 'Laravel',
}

const Layout = ({ children }) => {
    return (
        <div className="auth-page">
            <LoginLinks />
            <div className="container page">
                <div className="row">
                    <div className="col-md-6 offset-md-3 col-xs-12">
                        <h1 class="text-xs-center">Sign in</h1>
                        <p class="text-xs-center">
                            <a href="/register">Need an account?</a>
                        </p>

                        {children}
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Layout

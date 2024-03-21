import '@/app/global.css'
import Head from '@/app/(app)/Head'

export const metadata = {
    title: 'Laravel',
}
const RootLayout = ({ children }) => {
    return (
        <html lang="en">
            <Head />
            <body className="antialiased">{children}</body>
        </html>
    )
}

export default RootLayout

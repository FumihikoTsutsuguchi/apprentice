import HeadLink from '@/app/components/HeadLink'
import { Inter } from "next/font/google";
import "./globals.css";
import NavLink from "@/app/components/NavLink";

const inter = Inter({ subsets: ["latin"] });

export const metadata = {
    title: "Conduit",
};

export default function RootLayout({ children }) {
    return (
        <html lang="ja">
            <HeadLink />
            <body className={inter.className}>
                <NavLink />
                {children}
            </body>
        </html>
    );
}

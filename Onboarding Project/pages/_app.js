import 'bootstrap/dist/css/bootstrap.css'
import '../styles/globals.css'
import styles from "../styles/Home.module.css";
import Head from "next/head";
import {
  ApolloClient,
  createHttpLink,
  InMemoryCache,
  ApolloProvider,
  useQuery,
  gql,
} from "@apollo/client";
import { setContext } from "@apollo/client/link/context";
import Navbar from '../components/Navbar';
import 'react-toastify/dist/ReactToastify.css';
import Script from 'next/script';



/* Apollo Setting */
const httpLink = createHttpLink({
  uri: "https://api.github.com/graphql",
});
const authLink = setContext((_, { headers }) => {
  return {
    headers: {
      ...headers,
      authorization: `Bearer ${process.env.NEXT_PUBLIC_GITHUB_ACCESS_TOKEN}`,
    },
  };
});

const cache = new InMemoryCache({
  typePolicies: {
    Query: {
      fields: {
        searchRepositories: {
          keyArgs: [],
          merge(existing, incoming, { args: { offset = 0 }}) {
            console.log('existing', existing);
            console.log('incoming', incoming);
            // Slicing is necessary because the existing data is
            // immutable, and frozen in development.
            const merged = existing ? existing.slice(0) : [];
            for (let i = 0; i < incoming.length; ++i) {
              merged[offset + i] = incoming[i];
            }
            return merged;
          },
        },
      },
    },
  },
});

const client = new ApolloClient({
  link: authLink.concat(httpLink),
  cache: cache,
  // cache: new InMemoryCache(),
});
/* Apollo Setting */



function MyApp({ Component, pageProps }) {
  const getLayout = Component.getLayout || ((page) => page);

  return (
    <>
      <Head>
        <title>Richard Gunawan Onboarding Project</title>
        <meta name="description" content="GDP Labs Frontend Onboarding Project" />
        <link rel="icon" href="/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
      </Head>
      <ApolloProvider client={client}>

        <Navbar></Navbar>

        {getLayout(<Component {...pageProps} />)}
        {/* <Component {...pageProps} /> */}

        <footer className={styles.footer}>
          GLx Frontend Onboarding Project
        </footer>

        <Script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"/>

      </ApolloProvider>
    </>
  )
}

export default MyApp;
import 'bootstrap/dist/css/bootstrap.css'
import '../styles/globals.css'
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
const client = new ApolloClient({
  link: authLink.concat(httpLink),
  cache: new InMemoryCache(),
});
/* Apollo Setting */



function MyApp({ Component, pageProps }) {
  const getLayout = Component.getLayout || ((page) => page);

  return (
    <>
      <Head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
      </Head>
      <ApolloProvider client={client}>
        {getLayout(<Component {...pageProps} />)}
        {/* <Component {...pageProps} /> */}
      </ApolloProvider>
    </>
  )
}

export default MyApp;
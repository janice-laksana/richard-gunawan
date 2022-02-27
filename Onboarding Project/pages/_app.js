import '../styles/globals.css'
import {
  ApolloClient,
  createHttpLink,
  InMemoryCache,
  ApolloProvider,
  useQuery,
  gql,
} from "@apollo/client";
import { setContext } from "@apollo/client/link/context";

const httpLink = createHttpLink({
  uri: "https://api.github.com/graphql",
});

const authLink = setContext((_, { headers }) => {
  console.log('authLink', process.env.NEXT_PUBLIC_GITHUB_ACCESS_TOKEN)
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


function MyApp({ Component, pageProps }) {
  console.log('NEXT_PUBLIC_GITHUB_ACCESS_TOKEN', process.env.NEXT_PUBLIC_GITHUB_ACCESS_TOKEN);
  const getLayout = Component.getLayout || ((page) => page);

  return (
    <ApolloProvider client={client}>
      {getLayout(<Component {...pageProps} />)}
      {/* <Component {...pageProps} /> */}
    </ApolloProvider>
  )
}

export default MyApp;
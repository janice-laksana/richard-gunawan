import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpEvent, HttpHandler, HttpRequest, HttpParams } from '@angular/common/http';
import { exhaustMap, Observable, take } from 'rxjs';
import { AuthService } from './auth.service';

@Injectable({providedIn: 'root'})
export class AuthInterceptorService implements HttpInterceptor {
  constructor(private authService: AuthService) { }

  /**
   * take(1) - take the first value from the observable, and unsubscribe
   * exhaustMap - take the observable and map it to another observable
   */

  /**
   * Jadi alur awalnya adalah ambil user nya dari atuh service,
   * Jika user tidak ada, maka akan langsung ke next.handle(req)
   * Jika user ada, maka tambahi header token pada request
   */

  intercept(req: HttpRequest<any>, next: HttpHandler) {
    return this.authService.user.pipe(
      take(1),
      exhaustMap(user => {
        if (!user) {
          return next.handle(req);
        }
        const modifiedReq = req.clone({
          params: new HttpParams().set('auth', user.token)
        });
        return next.handle(modifiedReq);
      })
    );

  }
}
